<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Foreach_;

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

    public function assign_table(Request $request)
    {

        return view('Admin.Reservation.assign_table');
    }
}
