<?php

namespace App\Http\Controllers;

use App\Models\state;
use App\Models\branch;
use App\Models\parcel;
use Illuminate\Http\Request;
use App\Models\parcel_pickup;
use App\Models\parcel_category;
use App\Http\Controllers\NotificationController;

class ParcelController extends Controller
{
    // PICKUPS //
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

    // MANGE PARCELS //
    public function store(Request $request)
    {
        $parcel = new parcel;
        $parcel->trackingid = \Str::random(6);
        $parcel->sender = $request->sender;
        $parcel->reciever = $request->reciever;
        $parcel->sender_phone = $request->sphone;
        $parcel->reciever_phone = $request->rphone;
        $parcel->sender_email = $request->semail;
        $parcel->reciever_email = $request->remail;
        $parcel->reciever_address = $request->raddress;
        $parcel->destination_state_id = $request->sstate;
        $parcel->weight = $request->weight;
        $parcel->description = $request->desc;
        $parcel->current_address = $request->paddress;
        if($parcel->save()){
            return json_encode([
                'status' => 'success'
            ]);
        }else{
            return json_encode([
                'status' => 'error',
                'message' => 'An unexpected error occured! Please try again!'
            ]);
        }
    }

    public function fetch(Request $request)
    {
        $parcel = parcel::orderBy('created_at', 'DESC')->get();
        return $parcel;
    }


    // PARCEL CATEGORY MANAGEMENT //
    public function fetch_category()
    {
        $categories = parcel_category::orderBy('category')->get();
        return $categories;
    }

    public function store_category(Request $request)
    {
        if(!parcel_category::where('category', $request->category)->exists()){
            $category = new parcel_category;
            $category->category = $request->category;
            if($category->save()){
                return json_encode([
                    'status' => 'success'
                ]);
            }else{
                return json_encode([
                    'status' => 'error',
                    'message' => 'An unexpected error occured!'
                ]);
            }
        }else{
            return json_encode([
                'status' => 'error',
                'message' => 'Parcel Category already exists!'
            ]);
        }
    }

    public function delete_category(Request $request)
    {
        $delete = parcel_category::where('id', $request->id)->delete();
        if($delete){
            return json_encode([
                'status' => 'success'
            ]);
        }else{
            return json_encode([
                'status' => 'error',
                'message' => 'Parcel Category Unable to delete!'
            ]);
        }
    }

    // State Management
    public function fetch_states()
    {
        $states = state::orderBy('name')->get();
        return $states;
    }

    public function store_state(Request $request)
    {
        if(!state::where('name', $request->state)->exists()){
            $state = new state;
            $state->name = $request->state;
            if($request->has('slug')){
                $state->slug = $request->slug;
            }
            if($state->save()){
                return json_encode([
                    'status' => 'success'
                ]);
            }else{
                return json_encode([
                    'status' => 'error',
                    'message' => 'An unexpected error occured!'
                ]);
            }
        }else{
            return json_encode([
                'status' => 'error',
                'message' => 'State already exists!'
            ]);
        }
    }

    public function delete_state(Request $request)
    {
        $delete = state::where('id', $request->id)->delete();
        if($delete){
            return json_encode([
                'status' => 'success'
            ]);
        }else{
            return json_encode([
                'status' => 'error',
                'message' => 'Parcel Category Unable to delete!'
            ]);
        }
    }

    // Branch Management
    public function store_branch(Request $request)
    {
        if(!branch::where('name', $request->branch)->exists()){
            $branch = new branch;
            $branch->name = $request->branch;
            $branch->address = $request->address;
            $branch->phone = $request->phone;
            $branch->city = $request->city;
            $branch->state_id = $request->sstate;
            if($request->has('desc')){
                $branch->description = $request->desc;
            }
            if($branch->save()){
                return json_encode([
                    'status' => 'success'
                ]);
            }else{
                return json_encode([
                    'status' => 'error',
                    'message' => 'An unexpected error occured!'
                ]);
            }
        }else{
            return json_encode([
                'status' => 'error',
                'message' => 'Branch already exists!'
            ]);
        }
    }

    public function fetch_branch(Request $request)
    {
        $branch = branch::orderBy('name')->get();
        foreach ($branch as $value) {
            $value->state = $value->state;
        }
        return $branch;
    }

}
