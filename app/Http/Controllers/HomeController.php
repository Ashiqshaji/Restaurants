<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\Emailverification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('Frontend.Reservation.reservation');
    }




    // public  function insertOrUpdateCustomerSupplier($name,  $email, $mobile, $guests, $reservation_time, $reservation_date, $reservation_till)
    // {
    //     // Step 1: Check if the customer exists
    //     $existingCustomer = DB::table('mst_customer_supplier')
    //         ->where('email', $email)
    //         ->Where('mobile_no', $mobile)
    //         ->first();

    //     if ($existingCustomer) {
    //         // Step 2: Update the existing customer
    //         DB::table('mst_customer_supplier')
    //             ->where('cus_key', $existingCustomer->cus_key)
    //             ->update([
    //                 'customer_name' => $name,
    //                 'mobile_no' => $mobile,
    //                 'email' => $email,
    //             ]);
    //         DB::table('users')
    //             ->updateOrInsert(
    //                 ['cus_key' => $existingCustomer->cus_key], // Search criteria
    //                 [
    //                     'name' => $name,
    //                     'email' => $email,
    //                     'cus_key' => $existingCustomer->cus_key
    //                 ] // Data to update or insert
    //             );

    //         $cuskey = $existingCustomer->cus_key;
    //     } else {

    //         $cuskey = DB::table('sys_company_info')
    //             ->selectRaw('CAST(inv_loc_key AS NVARCHAR(50)) + cus_key AS cuskey')
    //             ->value('cuskey');

    //         // Step 4: Insert a new customer
    //         DB::table('mst_customer_supplier')->insert([
    //             'cus_key' => $cuskey,
    //             'customer_name' => $name,
    //             'mobile_no' => $mobile,
    //             'email' => $email,
    //             'type' => 'C',
    //             'email_status' => '1',
    //         ]);

    //         // Step 4: Insert a new customer
    //         DB::table('users')->insert([
    //             'cus_key' => $cuskey,
    //             'name' => $name,
    //             'email' => $email,
    //         ]);
    //     }



    //     DB::table('res_reserved_table')->insert([
    //         'cus_key' => $cuskey,
    //         'no_of_people' => $guests,
    //         'reservation_date' => $reservation_date,
    //         'reservation_from' => $reservation_time,
    //         'reservation_till' => $reservation_till,
    //         'reserved_on' => now(),
    //         'reserved_blocks' => $reservation_time,
    //         'reserved_by' => 'Admin',
    //         'status' => 'reserved',
    //     ]);

    //     return $cuskey;
    // }


    // public function insertOrUpdateCustomerSupplier($name, $email, $mobile, $guests, $reservation_time, $reservation_date, $reservation_till)
    // {
    //     // Step 1: Check if the customer exists
    //     $existingCustomer = DB::table('mst_customer_supplier')
    //         ->select('cus_key')
    //         ->where('mobile_no', $mobile)
    //         ->first();



    //     if (!$existingCustomer) {
    //         $cuskey = DB::table('sys_company_info')
    //             ->selectRaw('CAST(inv_loc_key AS NVARCHAR(50)) + cus_key AS cuskey')
    //             ->value('cuskey');

    //         DB::table('mst_customer_supplier')->insert([
    //             'cus_key' => $cuskey,
    //             'customer_name' => $name,
    //             'mobile_no' => $mobile,
    //             'email' => $email,
    //             'type' => 'C',
    //             'email_status' => '1',
    //         ]);

    //     } else {
    //         $cuskey = $existingCustomer->cus_key;
    //         DB::table('mst_customer_supplier')
    //             ->where('cus_key', $cuskey)
    //             ->update([
    //                 'customer_name' => $name,
    //                 'mobile_no' => $mobile,
    //                 'email' => $email,

    //             ]);
    //     }



    //     DB::table('res_reserved_table')->insert([
    //         'cus_key' => $cuskey,
    //         'no_of_people' => $guests,
    //         'reservation_date' => $reservation_date,
    //         'reservation_from' => $reservation_time,
    //         'reservation_till' => $reservation_till,
    //         'table_no'=>NULL,
    //         'sectionID'=>null,
    //         'reserved_on' => now(),
    //         'reserved_blocks' => $reservation_time,
    //         'reserved_by' => 'Admin',
    //         'status' => 'reserved',
    //     ]);




    //     return $cuskey;
    // }

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
            DB::table('res_reserved_table')->insert([
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

            // Commit the transaction
            DB::commit();

            return $cuskey;
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
    public function Save_Reservation(Request $request)
    {

        $reservation_time = $this->convertToAmPm($request->reservation_time);

        $reservation_till = $this->addOneHour($request->reservation_time);


        $cuskey =  $this->insertOrUpdateCustomerSupplier(
            $request->name,
            $request->email,
            $request->mobile,
            $request->guests,
            $reservation_time,
            $request->reservation_date,
            $reservation_till

        );


        $emailstatus = DB::table('mst_customer_supplier')
            ->select('email_status', 'cus_key', 'email', 'customer_name')
            ->where('cus_key', $cuskey)
            ->where(function ($query) {
                $query->where('email_status', '1')
                    ->orWhereNull('email_status');
            })
            ->first();

        if ($emailstatus) {



            $this->sendEmail($emailstatus);
            return response()->json(['status' => $emailstatus]);
        } else {
            return response()->json(['status' => $emailstatus]);
        }
    }

    // public function sendEmail()
    // {

    //     print_r('email');
    //     die();
    //     $data = [
    //         'name' => 'John Doe',
    //         'message' => 'This is a custom email message.',
    //     ];

    //     Mail::to('ashiqshaji072024@gmail.com')->send(new Emailverification($data));
    // }
    public function sendEmail($emailstatus)
    {

        try {
            $data = [
                'name' => $emailstatus->customer_name,
                'message' => 'This is a custom email message.',

            ];
            $encryptedKey = Crypt::encryptString($emailstatus->cus_key);

            Mail::to($emailstatus->email)->queue(new Emailverification($data, $encryptedKey));



            return response()->json(['message' => 'Email sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
        }
    }

    // public function sendEmail()
    // {

    //     try {
    //         $data = [
    //             'name' => '1111',
    //             'message' => 'This is a custom email message.',

    //         ];
    //         $encryptedKey = Crypt::encryptString('1111');

    //         // Mail::to($emailstatus->email)->queue(new Emailverification($data, $encryptedKey));

    //         Mail::to('ashiqakkarayiluae@gmail.com')->queue(new Emailverification($data, $encryptedKey));

    //         return response()->json(['message' => 'Email sent successfully!']);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
    //     }
    // }


    public function verifyEmail(Request $request)
    {
        try {
            $cuskey = Crypt::decryptString($request->query('token'));

            DB::table('mst_customer_supplier')
                ->where('cus_key', $cuskey)
                ->update([
                    'email_status' => 2,
                ]);

            return view('Email.Thankyou');
            // return response()->json(['message' => 'Email verified successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid or expired link.'], 400);
        }
    }
}
