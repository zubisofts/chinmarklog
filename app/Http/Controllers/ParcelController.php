<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\rider;
use App\Models\state;
use App\Models\branch;
use App\Models\parcel;
use Illuminate\Http\Request;
use App\Models\parcel_pickup;
use App\Models\quote_request;
use App\Models\assigned_parcel;
use App\Models\assigned_pickup;
use App\Models\parcel_category;
use App\Event\UpdateParcelStatus;
use Illuminate\Support\Facades\Auth;
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
            // $notify->saveNotice('There is a new pickup request from ' . $pp->sender, 'pickup');
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
        $parcel->category_id = $request->category;
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
        $parcels = parcel::orderBy('created_at', 'DESC')->get();
        foreach ($parcels as $parcel) {
            $parcel->category = $parcel->category;
        }
        return $parcels;
    }

    public function asign_rider(Request $request)
    {
        if(!assigned_parcel::where('rider_id', $request->riderid)->where('parcel_id', $request->parcelid)->exists()){
            $assign = new assigned_parcel;
            $assign->parcel_id = $request->parcelid;
            $assign->rider_id = $request->riderid;
            $assign->description = 'Parcel with Parcel ID ' . $request->parcelid . ' assigned to rider with ID ' . $request->riderid;
            if($assign->save()){
                $parcel = parcel::where('id', $assign->parcel_id)->first();
                $parcel->status = 'assigned';
                $parcel->update();
                $this->sendNotification($parcel, $request->riderid, 'assigned', 'You have been assigned a parcel');
                return response()->json([
                    'status' => 'success'
                ], 200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'An unexpected error occured!'
                ], 200);
            }
        }else{
            $parcel = parcel::where('id', $request->parcelid)->first();
            $parcel->status = 'assigned';
            $parcel->update();
            return response()->json([
                'status' => 'error',
                'message' => 'Detected existing assignment for the parcel'
            ], 200);
        }
    }

    // MANAGE PARCEL FOR RIDERS
    public function fetch_rider_parcel_list(Request $request)
    {
        $rider = rider::where('email', $request->user['email'])->first();
        $parcelArray = [];
        $assigned = assigned_parcel::where('rider_id', $rider->id)->get();
        foreach ($assigned as $value) {
            array_push($parcelArray, $value->parcel);
        }
        return $parcelArray;
    }

    public function decline_parcel(Request $request)
    {
        $rider = rider::where('email', $request->user['email'])->first();
        if(assigned_parcel::where('rider_id', $rider->id)->where('parcel_id', $request->parcelid)->delete()){
            $parcel = parcel::where('id', $request->parcelid)->first();
            $parcel->status = 'unassigned';
            $parcel->update();
            return response()->json([
                'status' => 'success'
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Could not decline the request!'
            ], 200);
        }
    }
    
    public function confirm_parcel(Request $request)
    {
        $rider = rider::where('email', $request->user['email'])->first();
        if(assigned_parcel::where('rider_id', $rider->id)->where('parcel_id', $request->parcelid)->exists()){
            $parcel = parcel::where('id', $request->parcelid)->first();
            $parcel->status = 'transit';
            $parcel->update();
            return response()->json([
                'status' => 'success'
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have the permission to confirm this parcel.'
            ], 200);
        }
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

    public function check_trackid(Request $request){
        $getParcel = parcel::where('trackingid',$request->trackid)->get();
        $now = date('U');
        if(count($getParcel) > 0){
            $result = [
                'count' => count($getParcel),
                'parceldetail' => $getParcel,
                'now' => $now
            ];
        }else{
            $result = [
                'count' => count($getParcel)
            ];
        }

        return json_encode($result);
    }

    // Pickup Request / Management //
    public function pick_list(Request $request)
    {
        $pickups = parcel_pickup::orderBy('created_at', 'DESC')->get();
        foreach ($pickups as $pickup) {
            $pickup->category = $pickup->category;
        }
        return $pickups;
    }

    public function rider_pick_list(Request $request)
    {
        $rider = rider::where('email', $request->user['email'])->first();
        $parcelArray = [];
        $assigned = assigned_pickup::where('rider_id', $rider->id)->get();
        foreach ($assigned as $value) {
            $value->pickup->category = $value->pickup->category;
            array_push($parcelArray, $value->pickup);
        }
        return $parcelArray;
    }

    public function decline_pickup(Request $request)
    {
        $rider = rider::where('email', $request->user['email'])->first();
        if(assigned_pickup::where('rider_id', $rider->id)->where('parcel_id', $request->parcelid)->delete()){
            $parcel = parcel_pickup::where('id', $request->parcelid)->first();
            $parcel->status = 'seen';
            $parcel->update();
            return response()->json([
                'status' => 'success'
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Could not decline the request!'
            ], 200);
        }
    }
    
    public function confirm_pickup(Request $request)
    {
        $rider = rider::where('email', $request->user['email'])->first();
        if(assigned_pickup::where('rider_id', $rider->id)->where('parcel_id', $request->parcelid)->exists()){
            // Create a new Parcel with pickup data
            $pickup = parcel_pickup::where('id', $request->parcelid)->first();
            $parcel = new parcel;
            $parcel->trackingid = \Str::random(6);
            $parcel->sender = $pickup->sender;
            $parcel->reciever = $pickup->reciever;
            $parcel->sender_phone = $pickup->sender_phone;
            $parcel->reciever_phone = $pickup->reciever_phone;
            $parcel->sender_email = $pickup->sender_email;
            $parcel->reciever_email = $pickup->reciever_email;
            $parcel->reciever_address = $pickup->delivery_location;
            $parcel->weight = $pickup->weight;
            $parcel->category_id = $pickup->category_id;
            $parcel->description = $pickup->description;
            if($parcel->save()){
                // Updated the pickup status to saved
                $pickup->status = 'saved';
                $pickup->update();
                // Assign parcel to the same rider
                $assignment = assigned_pickup::where('rider_id', $rider->id)->where('parcel_id', $request->parcelid)->first();
                $assign = new assigned_parcel;
                $assign->parcel_id = $parcel->id;
                $assign->rider_id = $assignment->rider_id;
                $assign->description = "You have confirmed the pickup request with tracking id: '" . $parcel->trackingid . "' for transit.";
                if($assign->save()){
                    $parcel->status = 'transit';
                    $parcel->update();
                    return response()->json([
                        'status' => 'success'
                    ], 200);
                }else{
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Parcel saved but could not be assigned to you for transit.'
                    ], 200);
                }
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Could not save the pickup as parcel due to an unexpected error! Please try again.'
                ], 200);
            }
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have the permission to confirm this parcel.'
            ], 200);
        }
    }

    public function asign_pickup_rider(Request $request)
    {
        if(!assigned_pickup::where('rider_id', $request->riderid)->where('parcel_id', $request->parcelid)->exists()){
            $assign = new assigned_pickup;
            $assign->parcel_id = $request->parcelid;
            $assign->rider_id = $request->riderid;
            $assign->description = 'You have been requested to pickup a parcel with Parcel ID ' . $request->parcelid . ' assigned to rider with ID ' . $request->riderid;
            if($assign->save()){
                $parcel = parcel_pickup::where('id', $assign->parcel_id)->first();
                $parcel->status = 'assigned';
                $parcel->update();
                return response()->json([
                    'status' => 'success'
                ], 200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'An unexpected error occured!'
                ], 200);
            }
        }else{
            $parcel = parcel_pickup::where('id', $request->parcelid)->first();
            $parcel->status = 'assigned';
            $parcel->update();
            return response()->json([
                'status' => 'error',
                'message' => 'Detected existing assignment for the parcel'
            ], 200);
        }
    }

    // Quote Management
    public function request_quote(Request $request)
    {
        $quote_request = new quote_request;
        $quote_request->name = $request->fname;
        $quote_request->phone = $request->phone;
        $quote_request->email = $request->email;
        $quote_request->company = $request->company;
        $quote_request->description = $request->desc;
        $quote_request->category_id = $request->category_id;
        $quote_request->weight = $request->weight;
        $quote_request->departure_address = $request->departure_addr;
        $quote_request->destination = $request->delivery_addr;
        if($quote_request->save()){
            return json_encode([
                'status' => 'success',
                'message' => 'Your quote request was well recieved! We will get back to you soon!'
            ]);
        }else{
            return json_encode([
                'status' => 'error',
                'message' => 'An unexpected error occured! Please try again!'
            ]);
        }
    }

    public function fetch_quote_request(Request $request)
    {
        if($request->filter == 'all'){
            $quote_request = quote_request::orderBy('created_at', 'DESC')->get();
        }else{
            $quote_request = quote_request::where('status', $request->filter)->orderBy('created_at', 'DESC')->get();
        }
        foreach ($quote_request as $quote) {
            $quote->category = $quote->category;
        }
        return $quote_request;
    }

    public function sendNotification($parcel, $riderid, $status = 'assigned', $message = null)
    {
        // fetch rider
        $rider = rider::where('id', $riderid)->first();
        // fetch rider as user
        $user = User::where('email', $rider->email)->first();
        broadcast(new UpdateParcelStatus($parcel, $user, ['status'=>$status, 'message'=>$message]))->toOthers();
    }
}
