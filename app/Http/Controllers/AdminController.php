<?php

namespace App\Http\Controllers;

use App\Mail\EmailConformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Str;

use function Laravel\Prompts\table;

class AdminController extends Controller
{


    public function index(Request $request)
    {

        $data_seesion = $request->session()->pull('data');


        if (!empty($request->all())) {

            $today = Carbon::parse($request->data)->startOfDay();
            $date = Carbon::parse($request->data);
        } else {

            $today = Carbon::now()->startOfDay();

            $date = Carbon::now();
        }



        $formattedDate = $today->format('Y-m-d H:i:s');

        $currentTime = Carbon::now()->timezone('Asia/Dubai');
        $roundedCurrentTime =  $currentTime->copy()->addHour()->startOfHour(); // Example rounded time
        $roundedCurrentTimeStr =  $roundedCurrentTime->format('h:i A');


        // $groupedReservations = DB::table('res_reserved_table')
        //     ->select(
        //         'reserved_blocks',
        //         DB::raw('SUM(CASE WHEN table_no IS NULL THEN 1 ELSE 0 END) as null_tableid_count'),
        //         DB::raw('SUM(CASE WHEN table_no IS NOT NULL THEN 1 ELSE 0 END) as not_null_tableid_count')
        //     )
        //     ->where('reservation_date', $formattedDate)
        //     ->groupBy('reserved_blocks')
        //     ->where('status', 'reserved')
        //     ->get()
        //     ->keyBy('reserved_blocks')
        //     ->mapWithKeys(function ($item, $key) {
        //         $dateTime = \DateTime::createFromFormat('h:i A', $key);
        //         $formattedKey = $dateTime ? $dateTime->format('H:i') : $key;
        //         return [
        //             $formattedKey => [
        //                 'null_tableid_count' => $item->null_tableid_count,
        //                 'not_null_tableid_count' => $item->not_null_tableid_count,
        //             ]
        //         ];
        //     });

        $table_count = $this->tablesection()->count();
        $groupedReservations = DB::table('res_reserved_table')
            ->select(
                'reserved_blocks',
                DB::raw("SUM(CASE WHEN table_no IS NULL  THEN 1 ELSE 0 END) as null_tableid_count"),
                DB::raw("SUM(CASE WHEN table_no IS NOT NULL AND status = 'reserved' THEN 1 ELSE 0 END) as not_null_tableid_reserved_count"),
                DB::raw("SUM(CASE WHEN status = 'checkedin' THEN 1 ELSE 0 END) as checked_in_count")
            )
            ->where('reservation_date', $formattedDate)
            ->where(function ($query) {
                $query->where('status', 'reserved')
                    ->orWhere('status', 'checkedin');
            })
            ->groupBy('reserved_blocks')
            ->get()
            ->keyBy('reserved_blocks')
            ->mapWithKeys(function ($item, $key) {
                $dateTime = \DateTime::createFromFormat('h:i A', $key);
                $formattedKey = $dateTime ? $dateTime->format('H:i') : $key;
                return [
                    $formattedKey => [
                        'null_tableid_count' => $item->null_tableid_count,
                        'not_null_tableid_reserved_count' => $item->not_null_tableid_reserved_count,
                        'checked_in_count' => $item->checked_in_count,
                    ]
                ];
            });


        $datalist = DB::table('res_reserved_table as restable')
            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('cus.customer_name', 'cus.mobile_no', 'cus.email', 'restable.no_of_people', 'restable.table_no', 'restable.id as table_id', 'restable.status as Status')
            ->where('restable.reservation_date', $formattedDate)
            ->where('restable.reserved_blocks', $roundedCurrentTimeStr)
            ->where(function ($query) {
                $query->where('restable.status', 'reserved')
                    ->orWhere('restable.status', 'checkedin');
            })
            ->get();




        [$notNulltable, $isNulltable] = $datalist->partition(function ($item) {
            return !is_null($item->table_no);
        });



        $notNulltable = $notNulltable->toArray();
        $isNulltable = $isNulltable->toArray();
        usort($notNulltable, function ($a, $b) {
            $statusOrder = ['checkedin' => 2, 'reserved' => 1];
            return $statusOrder[$a->Status] <=> $statusOrder[$b->Status];
        });




        return view('Admin.Reservation.list', compact('groupedReservations', 'notNulltable', 'isNulltable', 'date', 'table_count'));
    }

    public function  each_time_slot(Request $request)
    {

        $time = $request->time;
        $date = $request->date;

        $formattedDate = Carbon::parse($date)->startOfDay()->format('Y-m-d H:i:s');

        $timeCarbon = Carbon::parse($time);
        $roundedCurrentTime = $timeCarbon->copy()->roundHour();
        $roundedCurrentTimeStr = $roundedCurrentTime->format('h:i A');




        $datalist = DB::table('res_reserved_table as restable')
            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('cus.customer_name', 'cus.mobile_no', 'cus.email', 'restable.no_of_people', 'restable.table_no', 'restable.id as table_id', 'restable.status as Status')
            ->where('restable.reservation_date', $formattedDate)
            ->where('restable.reserved_blocks', $roundedCurrentTimeStr)
            ->where(function ($query) {
                $query->where('restable.status', 'reserved')
                    ->orWhere('restable.status', 'checkedin');
            })
            ->get();


        [$notNulltable, $isNulltable] = $datalist->partition(function ($item) {
            return !is_null($item->table_no);
        });


        $notNulltable = $notNulltable->toArray();
        $isNulltable = $isNulltable->toArray();
        usort($notNulltable, function ($a, $b) {
            $statusOrder = ['checkedin' => 2, 'reserved' => 1];
            return $statusOrder[$a->Status] <=> $statusOrder[$b->Status];
        });


        return view('Admin.Reservation.Partials.list', compact('notNulltable', 'isNulltable'));
    }

    public function  each_date(Request $request)
    {

        return response($request->Date);
    }

    public function assign_table(Request $request, $id)
    {


        $id = Crypt::decrypt($id);

        $section_id = DB::table('sys_Section as sys')
            ->select('sys.btnOrderID as btnOrderID', 'sys.Caption as Name')
            ->get();



        $data_user = DB::table('res_reserved_table as restable')

            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('cus.customer_name', 'cus.mobile_no', 'cus.email', 'restable.no_of_people', 'restable.table_no', 'restable.id as table_id', 'restable.reservation_date as reservation_date', 'restable.reserved_blocks as reserved_blocks')
            ->where('restable.id',  $id)
            ->first();


        // print_r($data_user->reservation_date);
        // die();




        return view('Admin.Reservation.assign_table', compact('data_user', 'section_id'));
    }

    // public function selectionsection(Request $request)
    // {

    //     $id = $request->tableid;
    //     $section_id = $request->section_id;


    //     $data_user = DB::table('res_reserved_table as restable')
    //         ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
    //         ->select('cus.customer_name', 'cus.mobile_no', 'cus.email', 'restable.no_of_people', 'restable.table_no', 'restable.id as table_id', 'restable.reservation_date as reservation_date', 'restable.reserved_blocks as reserved_blocks')
    //         ->where('restable.id',  $id)
    //         ->first();

    //     $leftJoinQuery = DB::table('sys_floorlayout_designer as fld_tab')
    //         ->leftJoin('trn_active_table as act_tab', function ($join) {
    //             $join->on('fld_tab.btnIndex', '=', 'act_tab.tableIndex')
    //                 ->on('fld_tab.btnSectionID', '=', 'act_tab.sectionID');
    //         })
    //         ->select('fld_tab.btnText', 'fld_tab.btnSectionID', 'act_tab.tableIndex')
    //         ->where('fld_tab.btnSectionID', $section_id);


    //     $rightJoinQuery = DB::table('trn_active_table as act_tab')
    //         ->rightJoin('sys_floorlayout_designer as fld_tab', function ($join) {
    //             $join->on('fld_tab.btnIndex', '=', 'act_tab.tableIndex')
    //                 ->on('fld_tab.btnSectionID', '=', 'act_tab.sectionID');
    //         })
    //         ->select('fld_tab.btnText', 'fld_tab.btnSectionID', 'act_tab.tableIndex')
    //         ->where('fld_tab.btnSectionID', $section_id);



    //     // $combinedResults = $leftJoinQuery->union($rightJoinQuery)->orderBy('btnText')->get();


    //     $combinedResults = $leftJoinQuery
    //         ->union($rightJoinQuery)
    //         ->orderBy('btnText')
    //         ->where('fld_tab.btnSectionID', $section_id) // Add your condition here
    //         ->get();


    //     // print_r($combinedResults);
    //     // die();

    //     $reserved_table_list = DB::table('res_reserved_table')
    //         ->where('reservation_date', $data_user->reservation_date)
    //         ->where('reserved_blocks', $data_user->reserved_blocks)
    //         ->whereNotNull('table_no')
    //         ->where(function ($query) {
    //             $query->where('status', 'reserved')
    //                 ->orWhere('status', 'checkedin');
    //         })
    //         ->get();

    //     // $mergedResults = $combinedResults->map(function ($item) use ($reserved_table_list) {

    //     //     $reservation = $reserved_table_list->firstWhere('table_no', 'F5');

    //     //     return (object) [
    //     //         'btnText' => $item->btnText,
    //     //         'btnTexts'  => Str::replace(' ', '', $item->btnText),
    //     //         'btnSectionID' => $item->btnSectionID,
    //     //         'tableIndex' => $item->tableIndex,
    //     //         'reservationData_color' => $reservation ? 'Yes' : 'No',

    //     //     ];
    //     // });


    //     $reservationsCollection = $reserved_table_list;
    //     $btnTextsCollection = $combinedResults;

    //     // Create a map of btnText for quick lookup
    //     $btnTextMap = $btnTextsCollection->keyBy(function ($item) {
    //         return trim($item['btnText']);
    //     });

    //     // Map reservations to the btnTexts collection
    //     $matchedReservations = $reservationsCollection->map(function ($reservation) use ($btnTextMap) {
    //         $btnText = trim($reservation['table_no']);
    //         $btnTextDetails = $btnTextMap->get($btnText, []);
    //         return array_merge($btnTextDetails, $reservation);
    //     });


    //     dd($matchedReservations);
    //     printf($combinedResults);
    //     die();
    //     return view('Admin.Reservation.Partials.table_list', compact('mergedResults'));
    // }

    public function selectionsection(Request $request)
    {

        $id = $request->tableid;
        $section_id = $request->section_id;

        // Fetch reservation details
        $data_user = DB::table('res_reserved_table as restable')
            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('cus.customer_name', 'cus.mobile_no', 'cus.email', 'restable.no_of_people', 'restable.table_no', 'restable.id as table_id', 'restable.reservation_date as reservation_date', 'restable.reserved_blocks as reserved_blocks')
            ->where('restable.id', $id)
            ->first();

        // Fetch combined results
        $leftJoinQuery = DB::table('sys_floorlayout_designer as fld_tab')
            ->leftJoin('trn_active_table as act_tab', function ($join) {
                $join->on('fld_tab.btnIndex', '=', 'act_tab.tableIndex')
                    ->on('fld_tab.btnSectionID', '=', 'act_tab.sectionID');
            })
            ->select('fld_tab.btnText', 'fld_tab.btnSectionID', 'act_tab.tableIndex')
            ->where('fld_tab.btnSectionID', $section_id);

        $rightJoinQuery = DB::table('trn_active_table as act_tab')
            ->rightJoin('sys_floorlayout_designer as fld_tab', function ($join) {
                $join->on('fld_tab.btnIndex', '=', 'act_tab.tableIndex')
                    ->on('fld_tab.btnSectionID', '=', 'act_tab.sectionID');
            })
            ->select('fld_tab.btnText', 'fld_tab.btnSectionID', 'act_tab.tableIndex')
            ->where('fld_tab.btnSectionID', $section_id);

        // Union and fetch combined results
        $combinedResults = $leftJoinQuery
            ->union($rightJoinQuery)
            ->orderBy('btnText')
            ->get();

        // Fetch reserved tables
        $reserved_table_list = DB::table('res_reserved_table')
            ->where('reservation_date', $data_user->reservation_date)
            ->where('reserved_blocks', $data_user->reserved_blocks)
            ->whereNotNull('table_no')
            ->where(function ($query) {
                $query->where('status', 'reserved')
                    ->orWhere('status', 'checkedin');
            })
            ->get();

        // Convert collections to arrays if necessary
        $reserved_table_list = $reserved_table_list->map(function ($item) {
            return (array) $item;
        });

        $combinedResults = $combinedResults->map(function ($item) {
            return (array) $item;
        });

        // Create a map of btnText for quick lookup
        $btnTextMap = collect($combinedResults)->keyBy(function ($item) {
            return trim($item['btnText']);
        });

        // Map reservations to the btnTexts collection
        $matchedReservations = collect($combinedResults)->map(function ($item) use ($reserved_table_list, $btnTextMap) {
            $btnText = trim($item['btnText']);
            $reservation = collect($reserved_table_list)->firstWhere(function ($reservation) use ($btnText) {
                return trim($reservation['table_no']) === $btnText;
            });

            return (object) [
                'btnText' => $item['btnText'],
                'btnTexts' => Str::replace(' ', '', $item['btnText']),
                'btnSectionID' => $item['btnSectionID'],
                'tableIndex' => $item['tableIndex'],
                'reservationData_color' => $reservation ? 'Yes' : 'No',
                'reservationDetails' => $reservation ?: null,
            ];
        });

        // // Output or store the results
        // dd($matchedReservations);

        return view('Admin.Reservation.Partials.table_list', compact('matchedReservations'));
    }



    public function selectiontable(Request $request)
    {

        $table_id = $request->table_id;

        $reserved_table_list = DB::table('res_reserved_table as restable')
            ->where('restable.id',   $table_id)
            ->first();

        // $table_section = $this->tablesection()->toArray();
        // // $result = $table_section->mapWithKeys(function ($item) {
        // //     return [$item->btnSectionID => $item->btnText];
        // // })->toArray();


        // print_r($request->all());



        $checkboxValues = $request->input('selected_items', []);

        if (empty($checkboxValues)) {

            return redirect()->back()->with('error', 'No items selected.');
        }

        $i = 0;
        foreach ($checkboxValues as $value) {

            $originalText = $value;
            $position = 5;
            $modifiedText = substr($originalText, 0, $position) . ' ' . substr($originalText, $position);

            $data_section = DB::table('sys_floorlayout_designer as fld_tab')
                ->select('fld_tab.btnSectionID as btnSectionID', 'fld_tab.btnIndex as btnIndex')
                ->where('fld_tab.btnText', $modifiedText)->first();

            if ($i == 0) {
                DB::table('res_reserved_table')
                    ->where('id', $table_id) // Use the appropriate condition
                    ->update([
                        'table_no' => $modifiedText, // Assuming $modifiedText is defined elsewhere
                        'sectionID' => $data_section->btnSectionID, // Use value from request or null
                        'reserved_on' => now(),
                        'status' => 'reserved',
                        'tableIndex' => $data_section->btnIndex
                    ]);
            } else {


                DB::table('res_reserved_table')->insert([
                    'cus_key' => $reserved_table_list->cus_key,
                    'no_of_people' =>  $reserved_table_list->no_of_people,
                    'reservation_date' =>  $reserved_table_list->reservation_date,
                    'reservation_from' =>  $reserved_table_list->reservation_from,
                    'reservation_till' =>  $reserved_table_list->reservation_till,
                    'table_no' =>  $modifiedText,
                    'sectionID' => $data_section->btnSectionID,
                    'reserved_on' => now(),
                    'reserved_blocks' =>  $reserved_table_list->reserved_blocks,
                    'reserved_by' => 'Admin',
                    'status' => 'reserved',
                    'tableIndex' => $data_section->btnIndex,
                ]);
            }

            $i++;
        }
        $date = $reserved_table_list->reservation_date;

        // if ($request->has('selected_items')) {
        //     foreach ($request->selected_items as $selectedItem) {
        //         // Print each selected item
        //         print_r($selectedItem);
        //     }
        // } else {
        //     echo 'No items selected.';
        // }
        // print_r($modifiedText);

        $this->comfrmsendEmail($reserved_table_list->cus_key, $reserved_table_list->reserved_blocks, $date, $reserved_table_list->no_of_people);
        return redirect()->route('admin.reservationlist')->with('date', $date);

        // die();
    }

    public function comfrmsendEmail($cus_key, $reserved_blocks, $date, $no_of_people)
    {

        $data_user = DB::table('res_reserved_table as restable')
            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('restable.table_no', 'restable.id as table_id')
            ->where('restable.cus_key', $cus_key)
            ->where('restable.reserved_blocks', $reserved_blocks)
            ->where('restable.reservation_date', $date)
            ->get();

        $data_user_name = DB::table('mst_customer_supplier as cus')
            ->select('cus.customer_name', 'cus.mobile_no', 'cus.email',)
            ->where('cus.cus_key', $cus_key)->first();




        // print_r($data);
        // die();

        try {
            $data = [
                'Name' => $data_user_name->customer_name,
                'Date' => $date,
                'Time' => $reserved_blocks,
                'People' => $no_of_people,
                'Table' => $data_user,
                'message' => 'Reservation Is Confirmed',

            ];

            // $encryptedKey = Crypt::encryptString($data_user_name->cus_key);

            Mail::to($data_user_name->email)->queue(new EmailConformation($data));



            return response()->json(['message' => 'Email sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
        }
    }

    public function tablesection()
    {
        return DB::table('sys_floorlayout_designer as fld_tab')
            ->select('fld_tab.btnText', 'fld_tab.btnSectionID')
            ->get();
    }
    public function assign_table_edit($id)
    {

        $id = Crypt::decrypt($id);

        $section_id = DB::table('sys_Section as sys')
            ->select('sys.btnOrderID as btnOrderID', 'sys.Caption as Name')
            ->get();



        $data_user = DB::table('res_reserved_table as restable')

            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('restable.cus_key as cus_keyres', 'cus.customer_name', 'cus.mobile_no', 'cus.email', 'restable.no_of_people', 'restable.table_no', 'restable.id as table_id', 'restable.reservation_date as reservation_date', 'restable.reserved_blocks as reserved_blocks')
            ->where('restable.id',  $id)
            ->first();



        $data_user_selected = DB::table('res_reserved_table as restable')
            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('restable.table_no', 'restable.id as table_id')
            ->where('restable.cus_key', $data_user->cus_keyres)
            ->where('restable.reservation_date', $data_user->reservation_date)
            ->where('restable.reserved_blocks', $data_user->reserved_blocks)
            ->where('restable.status', 'reserved')
            ->get();


        // print_r($data_user_selected);
        // die();


        return view('Admin.Reservation.edittable', compact('data_user', 'section_id', 'data_user_selected'));
    }

    public function Removetable(Request $request)
    {


        $data_user = DB::table('res_reserved_table as restable')

            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('restable.cus_key as cus_keyres', 'cus.customer_name', 'cus.mobile_no', 'cus.email', 'restable.no_of_people', 'restable.table_no', 'restable.id as table_id', 'restable.reservation_date as reservation_date', 'restable.reserved_blocks as reserved_blocks')
            ->where('restable.id',  $request->table_id_update)
            ->first();

        $date = $data_user->reservation_date;

        $data_user_selected = DB::table('res_reserved_table as restable')
            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('restable.table_no', 'restable.id as table_id')
            ->where('restable.cus_key', $data_user->cus_keyres)
            ->where('restable.reservation_date', $data_user->reservation_date)
            ->where('restable.reserved_blocks', $data_user->reserved_blocks)
            ->get();

        $data_user_selected_ids = $data_user_selected->pluck('table_id')->toArray();
        $checkboxValues = $request->input('selected_item_update', []);

        foreach ($checkboxValues as $value) {

            // DB::table('res_reserved_table')->where('id', $value)->delete();

            DB::table('res_reserved_table')
                ->where('id', $value) // Use the appropriate condition
                ->update([
                    'updated_on' => now(),
                    'status' => 'cancelled',
                ]);
        }

        $data_user_selected_count = $data_user_selected->count();
        $checkboxValues_count = count($checkboxValues);

        if ($data_user_selected_count === $checkboxValues_count) {
            return redirect()->route('admin.reservationlist')->with('date', $date);
        } else {


            $diff = array_diff($data_user_selected_ids, $checkboxValues);
            $firstNonMatchingId = !empty($diff) ? array_shift($diff) : null;

            $encryptedId = Crypt::encrypt($firstNonMatchingId);

            return redirect()->route('admin.assigntableedit', ['id' => $encryptedId])->with('date', $date);
        }
    }

    public function addreservation()
    {

        return view('Admin.Reservation.add_reservation');
        // print_r('kjskdjasdh');
        // die();
    }

    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $results = DB::table('mst_customer_supplier')
            ->where('mobile_no', 'LIKE', "%{$query}%")
            ->get(['cus_key', 'mobile_no']); // Return necessary fields

        return response()->json($results);
    }
    public function reservation_date(Request $request)
    {
        $formattedDate = Carbon::parse($request->Date)->format('Y-m-d');

        $date = Carbon::parse($request->Date);

        $currentTime = Carbon::now()->timezone('Asia/Dubai');
        $roundedCurrentTime =  $currentTime->copy()->roundHour(); // Example rounded time
        $roundedCurrentTimeStr =  $roundedCurrentTime->format('h:i A');


        // $groupedReservations = DB::table('res_reserved_table')
        //     ->select('reserved_blocks', DB::raw('COUNT(*) as count'))
        //     ->where('reservation_date', $formattedDate)
        //     ->groupBy('reserved_blocks')
        //     ->get()
        //     ->keyBy('reserved_blocks'); // Index by reserved_blocks for easy lookup


        // $groupedReservations = $groupedReservations->mapWithKeys(function ($item, $key) {
        //     $dateTime = \DateTime::createFromFormat('h:i A', $key);
        //     $formattedKey = $dateTime ? $dateTime->format('H:i') : $key;
        //     return [$formattedKey => $item];
        // });

        // $groupedReservations = DB::table('res_reserved_table')
        //     ->select(
        //         'reserved_blocks',
        //         DB::raw('SUM(CASE WHEN table_no IS NULL THEN 1 ELSE 0 END) as null_tableid_count'),
        //         DB::raw('SUM(CASE WHEN table_no IS NOT NULL THEN 1 ELSE 0 END) as not_null_tableid_count')
        //     )
        //     ->where('reservation_date', $formattedDate)
        //     ->where('status', 'reserved')
        //     ->groupBy('reserved_blocks')
        //     ->get()
        //     ->keyBy('reserved_blocks')
        //     ->mapWithKeys(function ($item, $key) {
        //         $dateTime = \DateTime::createFromFormat('h:i A', $key);
        //         $formattedKey = $dateTime ? $dateTime->format('H:i') : $key;
        //         return [
        //             $formattedKey => [
        //                 'null_tableid_count' => $item->null_tableid_count,
        //                 'not_null_tableid_count' => $item->not_null_tableid_count,
        //             ]
        //         ];
        //     });

        $table_count = $this->tablesection()->count();
        $groupedReservations = DB::table('res_reserved_table')
            ->select(
                'reserved_blocks',
                DB::raw("SUM(CASE WHEN table_no IS NULL  THEN 1 ELSE 0 END) as null_tableid_count"),
                DB::raw("SUM(CASE WHEN table_no IS NOT NULL AND status = 'reserved' THEN 1 ELSE 0 END) as not_null_tableid_reserved_count"),
                DB::raw("SUM(CASE WHEN status = 'checkedin' THEN 1 ELSE 0 END) as checked_in_count")
            )
            ->where('reservation_date', $formattedDate)
            ->where(function ($query) {
                $query->where('status', 'reserved')
                    ->orWhere('status', 'checkedin');
            })
            ->groupBy('reserved_blocks')
            ->get()
            ->keyBy('reserved_blocks')
            ->mapWithKeys(function ($item, $key) {
                $dateTime = \DateTime::createFromFormat('h:i A', $key);
                $formattedKey = $dateTime ? $dateTime->format('H:i') : $key;
                return [
                    $formattedKey => [
                        'null_tableid_count' => $item->null_tableid_count,
                        'not_null_tableid_reserved_count' => $item->not_null_tableid_reserved_count,
                        'checked_in_count' => $item->checked_in_count,
                    ]
                ];
            });




        return view('Admin.Reservation.partials.timeslot',  ['groupedReservations' => $groupedReservations, 'table_count' => $table_count])->render();
    }

    public function addnewreservation(Request $request)
    {
        $validatedData = $request->validate([
            'Mobile' => 'required|regex:/^05\d{8}$/',
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Guest' => 'required|integer|min:1',
        ]);



        try {
            // Proceed with storing the data

            $mobile = $validatedData['Mobile'];
            $name = $validatedData['Name'];
            $email = $validatedData['Email'];
            $guests = $validatedData['Guest'];
            $dateInput = Carbon::parse($request->dateInput)->startOfDay()->format('Y-m-d H:i:s');

            $reservation_time = $this->convertToAmPm($request->timeSlotInput);

            $reservation_till = $this->addOneHour($request->timeSlotInput);


            $cuskey =  $this->insertOrUpdateCustomerSupplier(
                $name,
                $email,
                $mobile,
                $guests,
                $reservation_time,
                $dateInput,
                $reservation_till

            );
            $encryptedId = Crypt::encrypt($cuskey['reservationId']);


            return redirect()->route('admin.assigntable', ['id' => $encryptedId])->with('date', $dateInput);

            // Redirect with a success message
            // return redirect()->route('reservations.index')->with('success', 'Reservation created successfully!');
        } catch (\Exception $e) {
            // Redirect back with an error message if something goes wrong
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }


    public function insertOrUpdateCustomerSupplier($name, $email, $mobile, $guests, $reservation_time, $reservation_date, $reservation_till)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Step 1: Check if the customer exists with caching
            $cuskey = Cache::remember("customer_cuskey_$mobile", 60, function () use ($mobile) {
                return DB::table('mst_customer_supplier')
                    ->where('mobile_no', $mobile)
                    ->value('cus_key');
            });

            if (!$cuskey) {
                // Generate cus_key for the new customer
                $cuskey = DB::table('sys_company_info')
                    ->selectRaw('CAST(inv_loc_key AS NVARCHAR(50)) + cus_key AS cuskey')
                    ->value('cuskey');

                // Insert new customer
                DB::table('mst_customer_supplier')->insert([
                    'cus_key' => $cuskey,
                    'customer_name' => $name,
                    'mobile_no' => $mobile,
                    'email' => $email,
                    'type' => 'C',
                    'email_status' => '1',
                ]);

                // Update the cache
                Cache::put("customer_cuskey_$mobile", $cuskey, 60);
            } else {
                // Update existing customer
                DB::table('mst_customer_supplier')
                    ->where('cus_key', $cuskey)
                    ->update([
                        'customer_name' => $name,
                        'mobile_no' => $mobile,
                        'email' => $email,
                    ]);
            }

            // Insert reservation data
            $reservationId = DB::table('res_reserved_table')->insertGetId([
                'cus_key' => $cuskey,
                'no_of_people' => $guests,
                'reservation_date' => $reservation_date,
                'reservation_from' => $reservation_time,
                'reservation_till' => $reservation_till,
                'table_no' => NULL,
                'sectionID' => null,
                'reserved_on' => now(),
                'reserved_blocks' => $reservation_time,
                'reserved_by' => 'Admin',
                'status' => 'reserved',
            ]);

            $data = [
                'reservationId' => $reservationId,
                'cuskey' => $cuskey,
            ];

            // Commit the transaction
            DB::commit();

            return $data;
        } catch (\Exception $e) {
            // Rollback the transaction on failure
            DB::rollBack();

            // Log the exception and handle it as necessary
            throw $e;
        }
    }

    public function convertToAmPm($hour)
    {

        $date = \DateTime::createFromFormat('H:i', $hour);
        return $date->format('h:i A');
    }
    public function addOneHour($reservationTime)
    {

        $date = \DateTime::createFromFormat('H:i', $reservationTime);


        $date->modify('+1 hour');

        return $date->format('h:i A');
    }
    public function  searchmobiledate(Request $request)
    {

        $time = $request->time;
        $date = $request->date;
        $mobile = $request->mobile;




        $formattedDate = Carbon::parse($date)->startOfDay()->format('Y-m-d H:i:s');

        $timeCarbon = Carbon::parse($time);
        $roundedCurrentTime = $timeCarbon->copy()->roundHour();
        $roundedCurrentTimeStr = $roundedCurrentTime->format('h:i A');




        // $datalist = DB::table('res_reserved_table as restable')

        //     ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
        //     ->select('cus.customer_name', 'cus.mobile_no', 'cus.email', 'restable.no_of_people', 'restable.table_no', 'restable.id as table_id')
        //     ->where('restable.reservation_date', $formattedDate)
        //     ->where('restable.reserved_blocks', $roundedCurrentTimeStr)
        //     ->get();

        $datalist = DB::table('res_reserved_table as restable')
            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select(
                'cus.customer_name',
                'cus.mobile_no',
                'cus.email',
                'restable.no_of_people',
                'restable.table_no',
                'restable.id as table_id'
            )
            ->where('restable.reservation_date', $formattedDate)
            ->where('restable.reserved_blocks', $roundedCurrentTimeStr)
            ->where('restable.status', 'reserved')
            ->where(function ($query) use ($mobile) {
                $query->where('cus.mobile_no', 'like', '%' . $mobile . '%')
                    ->orWhere('cus.customer_name', 'like', '%' . $mobile . '%');
            })
            ->get();

        [$notNulltable, $isNulltable] = $datalist->partition(function ($item) {
            return !is_null($item->table_no);
        });


        $notNulltable = $notNulltable->toArray();
        $isNulltable = $isNulltable->toArray();

        return view('Admin.Reservation.Partials.list', compact('notNulltable', 'isNulltable'));
    }

    public function checkin($id)
    {

        $id = Crypt::decrypt($id);

        $data_user = DB::table('res_reserved_table as restable')

            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('cus.customer_name', 'restable.cus_key as cus_keyres', 'cus.mobile_no', 'cus.email', 'restable.no_of_people', 'restable.table_no', 'restable.id as table_id', 'restable.reservation_date as reservation_date', 'restable.reserved_blocks as reserved_blocks')
            ->where('restable.id',  $id)
            ->first();


        $data_user_selected = DB::table('res_reserved_table as restable')
            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('restable.table_no', 'restable.id as table_id')
            ->where('restable.cus_key', $data_user->cus_keyres)
            ->where('restable.reservation_date', $data_user->reservation_date)
            ->where('restable.reserved_blocks', $data_user->reserved_blocks)
            ->get();

        foreach ($data_user_selected  as $value) {

            DB::table('res_reserved_table')
                ->where('id', $value->table_id) // Use the appropriate condition
                ->update([
                    'updated_on' => now(),
                    'status' => 'checkedin',
                ]);
        }


        return redirect()->route('admin.reservationlist');
    }
    public function canceldtable($id)
    {

        $id = Crypt::decrypt($id);

        $data_user = DB::table('res_reserved_table as restable')

            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('cus.customer_name', 'restable.cus_key as cus_keyres', 'cus.mobile_no', 'cus.email', 'restable.no_of_people', 'restable.table_no', 'restable.id as table_id', 'restable.reservation_date as reservation_date', 'restable.reserved_blocks as reserved_blocks')
            ->where('restable.id',  $id)
            ->first();


        $data_user_selected = DB::table('res_reserved_table as restable')
            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('restable.table_no', 'restable.id as table_id')
            ->where('restable.cus_key', $data_user->cus_keyres)
            ->where('restable.reservation_date', $data_user->reservation_date)
            ->where('restable.reserved_blocks', $data_user->reserved_blocks)
            ->get();

        foreach ($data_user_selected  as $value) {

            DB::table('res_reserved_table')
                ->where('id', $value->table_id) // Use the appropriate condition
                ->update([
                    'updated_on' => now(),
                    'status' => 'cancelled',
                ]);
        }


        return redirect()->route('admin.reservationlist');
    }
    public function autocompleteMobile(Request $request)
    {
        $term = $request->input('term');
        $mobiles = DB::table('mst_customer_supplier')
            ->where('mobile_no', 'LIKE', '%' . $term . '%')
            ->select('mobile_no', 'customer_name', 'email')
            ->get();

        // Ensure the response is an array of objects
        return response()->json($mobiles);
    }

    public function dashboard() {

        return view('Admin.layout.dashboard');
    }
}
