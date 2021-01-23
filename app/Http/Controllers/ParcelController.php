<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\parcel_pickup;
use App\Models\parcel_category;
use App\Http\Controllers\NotificationController;

class ParcelController extends Controller
{
    public function request_pickup(Request $request)
    {
        $notify = new NotificationController;
        $pp = new parcel_pickup;
        $pp->sender = $request->fname;
        $pp->reciever = $request->rfname;
        $pp->sender_phone = $request->phone;
        $pp->reciever_phone = $request->rphone;
        $pp->sender_email = $request->email;
        $pp->reciever_email = $request->remail;
        $pp->pickup_location = $request->pickup;
        $pp->delivery_location = $request->rlocation;
        $pp->category_id = $request->category;
        $pp->weight = $request->weight;
        $pp->description = $request->message;
        if($pp->save()){
            $notify->saveNotice('There is a new pickup request from ' . $pp->sender, 'pickup');
            return json_encode([
                'status' => 'success',
                'message' => 'Your <strong>Pickup Request</strong> was well received and is being processed! We will get back to you shortly.'
            ]);
        }else{
            return json_encode([
                'status' => 'error',
                'message' => 'An unexpected error occured! Please try again!'
            ]);
        }
    }


    public function fetch_category()
    {
        $categories = parcel_category::orderBy('category')->get();
        return $categories;
    }


}
