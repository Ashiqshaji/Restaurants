<?php

namespace App\Http\Controllers;

use App\Mail\EmailConformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Str;

class AdminController extends Controller
{


    public function index(Request $request)
    {



        if (!empty($request->all())) {

            $today = Carbon::parse($request->data)->startOfDay();
            $date = Carbon::parse($request->data);
        } else {

            $today = Carbon::now()->startOfDay();

            $date = Carbon::now();
        }



        $formattedDate = $today->format('Y-m-d H:i:s');

        $currentTime = Carbon::now()->timezone('Asia/Dubai');
        $roundedCurrentTime =  $currentTime->copy()->roundHour(); // Example rounded time
        $roundedCurrentTimeStr =  $roundedCurrentTime->format('h:i A');


        $groupedReservations = DB::table('res_reserved_table')
            ->select('reserved_blocks', DB::raw('COUNT(*) as count'))
            ->where('reservation_date', $formattedDate)
            ->groupBy('reserved_blocks')
            ->get()
            ->keyBy('reserved_blocks'); // Index by reserved_blocks for easy lookup
        $groupedReservations = $groupedReservations->mapWithKeys(function ($item, $key) {
            $dateTime = \DateTime::createFromFormat('h:i A', $key);
            $formattedKey = $dateTime ? $dateTime->format('H:i') : $key;
            return [$formattedKey => $item];
        });


        $datalist = DB::table('res_reserved_table as restable')

            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('cus.customer_name', 'cus.mobile_no', 'cus.email', 'restable.no_of_people', 'restable.table_no', 'restable.id as table_id')
            ->where('restable.reservation_date', $formattedDate)
            ->where('restable.reserved_blocks', $roundedCurrentTimeStr)
            ->get();


        [$notNulltable, $isNulltable] = $datalist->partition(function ($item) {
            return !is_null($item->table_no);
        });


        $notNulltable = $notNulltable->toArray();
        $isNulltable = $isNulltable->toArray();


        return view('Admin.Reservation.list', compact('groupedReservations', 'notNulltable', 'isNulltable', 'date'));
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
            ->select('cus.customer_name', 'cus.mobile_no', 'cus.email', 'restable.no_of_people', 'restable.table_no', 'restable.id as table_id')
            ->where('restable.reservation_date', $formattedDate)
            ->where('restable.reserved_blocks', $roundedCurrentTimeStr)
            ->get();


        [$notNulltable, $isNulltable] = $datalist->partition(function ($item) {
            return !is_null($item->table_no);
        });


        $notNulltable = $notNulltable->toArray();
        $isNulltable = $isNulltable->toArray();

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

    public function selectionsection(Request $request)
    {

        $id = $request->tableid;
        $section_id = $request->section_id;


        $data_user = DB::table('res_reserved_table as restable')
            ->join('mst_customer_supplier as cus', 'restable.cus_key', '=', 'cus.cus_key')
            ->select('cus.customer_name', 'cus.mobile_no', 'cus.email', 'restable.no_of_people', 'restable.table_no', 'restable.id as table_id', 'restable.reservation_date as reservation_date', 'restable.reserved_blocks as reserved_blocks')
            ->where('restable.id',  $id)
            ->first();

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



        // $combinedResults = $leftJoinQuery->union($rightJoinQuery)->orderBy('btnText')->get();


        $combinedResults = $leftJoinQuery
            ->union($rightJoinQuery)
            ->orderBy('btnText')
            ->where('fld_tab.btnSectionID', $section_id) // Add your condition here
            ->get();


        // print_r($combinedResults);
        // die();

        $reserved_table_list = DB::table('res_reserved_table')
            ->where('res_reserved_table.reservation_date', $data_user->reservation_date)
            ->where('res_reserved_table.reserved_blocks', $data_user->reserved_blocks)
            ->get();


        $mergedResults = $combinedResults->map(function ($item) use ($reserved_table_list) {

            $reservation = $reserved_table_list->firstWhere('table_no', $item->btnText);

            return (object) [
                'btnText' => $item->btnText,
                'btnTexts'  => Str::replace(' ', '', $item->btnText),
                'btnSectionID' => $item->btnSectionID,
                'tableIndex' => $item->tableIndex,
                'reservationData_color' => $reservation ? 'Yes' : 'No',

            ];
        });


        return view('Admin.Reservation.Partials.table_list', compact('mergedResults'));
    }

    // public function assign_table_list()
    // {
    //     $leftJoinQuery = DB::table('sys_floorlayout_designer as fld_tab')
    //         ->leftJoin('trn_active_table as act_tab', function ($join) {
    //             $join->on('fld_tab.btnIndex', '=', 'act_tab.tableIndex')
    //                 ->on('fld_tab.btnSectionID', '=', 'act_tab.sectionID');
    //         })
    //         ->select('fld_tab.btnText', 'fld_tab.btnSectionID', 'act_tab.tableIndex');


    //     $rightJoinQuery = DB::table('trn_active_table as act_tab')
    //         ->rightJoin('sys_floorlayout_designer as fld_tab', function ($join) {
    //             $join->on('fld_tab.btnIndex', '=', 'act_tab.tableIndex')
    //                 ->on('fld_tab.btnSectionID', '=', 'act_tab.sectionID');
    //         })
    //         ->select('fld_tab.btnText', 'fld_tab.btnSectionID', 'act_tab.tableIndex');



    //     $combinedResults = $leftJoinQuery->union($rightJoinQuery)->orderBy('btnText')->get();


    //     //     $combinedResults = $leftJoinQuery
    //     // ->union($rightJoinQuery)
    //     // ->orderBy('btnText')
    //     // ->where('fld_tab.btnSectionID', $desiredBtnSectionID) // Add your condition here
    //     // ->get();




    //     $reserved_table_list = DB::table('res_reserved_table')
    //         ->where('res_reserved_table.reservation_date', $data_user->reservation_date)
    //         ->where('res_reserved_table.reserved_blocks', $data_user->reserved_blocks)
    //         ->get();


    //     $mergedResults = $combinedResults->map(function ($item) use ($reserved_table_list) {

    //         $reservation = $reserved_table_list->firstWhere('table_no', $item->btnText);

    //         return (object) [
    //             'btnText' => $item->btnText,
    //             'btnTexts'  => Str::replace(' ', '', $item->btnText),
    //             'btnSectionID' => $item->btnSectionID,
    //             'tableIndex' => $item->tableIndex,
    //             'reservationData' => $reservation ? $reservation : 'No',
    //             'reservationData_color' => $reservation ? 'Yes' : 'No',

    //         ];
    //     });
    // }



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
                ->select('fld_tab.btnSectionID as btnSectionID')
                ->where('fld_tab.btnText', $modifiedText)->first();

            if ($i == 0) {
                DB::table('res_reserved_table')
                    ->where('id', $table_id) // Use the appropriate condition
                    ->update([
                        'table_no' => $modifiedText, // Assuming $modifiedText is defined elsewhere
                        'sectionID' => $data_section->btnSectionID, // Use value from request or null
                        'reserved_on' => now(),
                        'status' => 'reserved',
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
    public function assign_table_edit()
    {
       print_r("skdljfnljkd");die();
    }

}
