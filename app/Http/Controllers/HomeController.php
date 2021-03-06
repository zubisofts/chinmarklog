<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\rider;
use App\Models\parcel;
use App\Models\signature;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\parcel_pickup;
use App\Models\assigned_parcel;
use App\Models\assigned_pickup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

use Illuminate\Validation\ValidationException;
use Intervention\Image\ImageManagerStatic as Image;

class HomeController extends Controller
{
    public function register(Request $request)
    {
        if(!User::where('email', $request->email)->orWhere('phone', $request->phone)->exists()){
            return User::create([
                'firstname' => $request->fname,
                'lastname' => $request->lname !='' ? $request->lname : null,
                'phone' => $request->phone,
                'email' => $request->email,
                'usertype' => '1',
                'password' => Hash::make('12345678'),
            ]);
        }else{
            throw ValidationException::withMessage([
                'email' => ['User already exist!']
            ]);
        }
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            if($user->usertype == 1){
                // Get rider's details
                $rider = rider::where('email', $user->email)->first();
                $rider->branch = $rider->branch; //Fetch his branch office
                $rider->branch->state = $rider->branch->state; //Fetch his state
                $responseArray = [];
                $responseArray['token'] = $user->createToken('auth_user')->accessToken;
                $responseArray['user'] = $user;
                $responseArray['as_rider'] = $rider; //Add the rider details to the response
                return response(json_encode([
                    'status' => 'success',
                    'message' => '',
                    'result' => $responseArray
                ]), 200);
            }else{
                return response(json_encode([
                    'status' => 'error',
                    'message' => 'Only riders have access to this app.',
                    'result' => []
                ]), 200);
            }
            
        }else{
            return response(json_encode([
                'status' =>'error',
                'message' =>'Username or password entered is incorrect, Try again!',
                'result' => []
            ]), 200);
        }
    }

    // API Authenticated and Guarded Routes Starts Here.
    public function checkUsers(Request $request)
    {
        if($request->user()->tokens()){
            if($request->user()->usertype == '1'){
                $rider = rider::where('email', $request->user()->email)->first();
                $rider->branch = $rider->branch;
                $rider->branch->state = $rider->branch->state;
            }
            return response(json_encode([
                'status' =>'success',
                'message' =>'',
                'result' => [
                        'user'=>$request->user(),
                        'as_rider'=> $rider ? $rider : '', 
                        'token' => $request->user()->token()
                    ]
            ]), 200);
        }else{
            return response(json_encode([
                'status' =>'error',
                'message' =>'No Token found.',
                'result' => []
            ]), 200);
        }
    }

    public function logout(Request $request)
    {
        if($request->user()->tokens()->delete()){
            return response(json_encode([
                'status' =>'success',
                'message' =>'Logout Successfull',
                'result' => []
            ]), 200);
        }else{
            return response(json_encode([
                'status' =>'error',
                'message' =>'An unexpected error occured!',
                'result' => []
            ]), 200);
        }
    }

    public function retrieveToken(Request $request)
    {
        # code...
    }

    // Parcel Management
    public function parcel_list(Request $request)
    {
        $rider = rider::where('email', $request->user()->email)->first();
        $parcelArray = [];
        $assigned = assigned_parcel::where('rider_id', $rider->id)->get();
        foreach ($assigned as $value) {
            array_push($parcelArray, $value->parcel);
        }
        return response(json_encode([
            'status' => 'success',
            'message' => '',
            'result' => [
                    'parcel_list' => $parcelArray
                ]
        ]), 200);
    }

    public function decline_parcel(Request $request)
    {
        $rider = rider::where('email', $request->user()->email)->first();
        if(assigned_parcel::where('rider_id', $rider->id)->where('parcel_id', $request->parcelid)->delete()){
            $parcel = parcel::where('id', $request->parcelid)->first();
            $parcel->status = 'unassigned';
            $parcel->update();
            return response(json_encode([
                'status' => 'success',
                'message' => 'Parcel Declined Successfully.',
                'result' => []
            ]), 200);
        }else{
            return response(json_encode([
                'status' =>'error',
                'message' =>'Could not decline the request!',
                'result' => []
            ]), 200);
        }
    }
    
    public function confirm_parcel(Request $request)
    {
        $rider = rider::where('email', $request->user()->email)->first();
        if(assigned_parcel::where('rider_id', $rider->id)->where('parcel_id', $request->parcelid)->exists()){
            $parcel = parcel::where('id', $request->parcelid)->first();
            $parcel->status = 'transit';
            $parcel->update();
            return response(json_encode([
                'status' => 'success',
                'message' => 'Parcel Confirmed successfully and now on transit',
                'result' => []
            ]), 200);
        }else{
            return response(json_encode([
                'status' =>'error',
                'message' =>'You do not have the permission to confirm this parcel.',
                'result' => []
            ]), 200);
        }
    }

    public function update_parcel_status(Request $request)
    {
        // $parcelid = $request->parcel_id;
        if($request->action == 'stop_parcel'){
            $parcel = parcel::where('id', $request->parcelid)->first();
            $parcel->status = 'stopped';
            if($parcel->update()){
                return response(json_encode([
                    'status' =>'success',
                    'message' =>"Parcel delivery has been stopped successfully.",
                    'result' => []
                ]), 200);
            }
                return response(json_encode([
                    'status' =>'error',
                    'message' =>"There was an error completing the request",
                    'result' => []
                ]), 200);
            
            // $parcel->update();
        }elseif ($request->action == 'start_parcel') {
            $parcel = parcel::where('id', $request->parcelid)->first();
            $parcel->status = 'transit';
            $parcel->update();
        }elseif ($request->action == 'delivered') {
            if($request->hasFile('signature')){ //If request have image
                //get Image
                $image = $request->file('signature');
                //Get the Original File Name and path
                $thumbnail = $request->file('signature')->getClientOriginalName();
                //Get the filename only using native php 'pathinfo'
                $filename = pathinfo($thumbnail, PATHINFO_FILENAME);
                //Extract the Extension
                $ext = strtolower($request->file('signature')->getClientOriginalExtension());
                //prepare the file to be stored
                $nameToStore = $filename . '_'. time() .'.'. $ext;
                //upload the file
                $image_resize = Image::make($image->getRealPath());
                // To resize the image to a width of 600 and constrain aspect ratio (auto height)
                $image_resize->resize(600,  null, function ($constraint) {
                    $constraint->aspectRatio();
                    });
                $image_resize->orientate();
                if($image_resize->save(storage_path('app/public/images/signatures/'.$nameToStore))){
                    $signature = new signature;
                    $signature->parcel_id = $request->parcelid;
                    $signature->image = $nameToStore;
                    if($signature->save()){
                        $parcel = parcel::where('id', $request->parcelid)->first();
                        $parcel->status = 'delivered';
                        $parcel->update();
                        return response(json_encode([
                            'status' =>'success',
                            'message' =>"Parcel delivered and updated successfully.",
                            'result' => []
                        ]), 200);
                    }else{
                        unlink(storage_path('app/public/images/signatures/'.$nameToStore));
                        return response(json_encode([
                            'status' =>'error',
                            'message' =>"Could not save the signature and update parcel status! Please try again.",
                            'result' => []
                        ]), 200);
                    }
                }else{
                    return response(json_encode([
                        'status' =>'error',
                        'message' =>"An unexpected error occured while trying to save signature image file.",
                        'result' => []
                    ]), 200);
                }
            }else{
                return response(json_encode([
                    'status' =>'error',
                    'message' =>"Customer's signature could not be confirmed for delivery.",
                    'result' => []
                ]), 200);
            }
        }
    }

    public function update_profile(Request $request)
    {
        if($request->has('password')){
            // Check if old password matches the current password
            if(Hash::check($request->old_password, $request->user()->password)){
                $request->user()->password = Hash::make($request->password);
            }else{
                return response(json_encode([
                    'status' =>'error',
                    'message' =>"Wrong password. Please specify your old password correctly before changing to a new one.",
                    'result' => []
                ]), 200);
            }
        }

        if($request->user()->update()){
            return response(json_encode([
            'status' =>'success',
            'message' =>"Profile Updated successfully.",
            'result' => []
        ]), 200);
        }else{
            return response(json_encode([
                'status' =>'error',
                'message' =>"Unable to chnage password, make sure you entered the correct password.",
                'result' => []
            ]), 200);
        }
        
    }

    // Pickup Requests
    public function rider_pick_list(Request $request)
    {
        $rider = rider::where('email', $request->user()->email)->first();
        $parcelArray = [];
        $assigned = assigned_pickup::where('rider_id', $rider->id)->get();
        foreach ($assigned as $value) {
            $value->pickup->category = $value->pickup->category;
            array_push($parcelArray, $value->pickup);
        }
        return response(json_encode([
            'status' =>'success',
            'message' =>"Pickup list retrieved successfully.",
            'result' => [
                'pickup_list' => $parcelArray
            ]
        ]), 200);
    }

    public function decline_pickup(Request $request)
    {
        $rider = rider::where('email', $request->user()->email)->first();
        if(assigned_pickup::where('rider_id', $rider->id)->where('parcel_id', $request->parcelid)->delete()){
            $parcel = parcel_pickup::where('id', $request->parcelid)->first();
            $parcel->status = 'seen';
            $parcel->update();
            return response(json_encode([
                'status' =>'success',
                'message' =>"Pickup Declined successfully.",
                'result' => []
            ]), 200);
        }else{
            return response(json_encode([
                'status' =>'error',
                'message' =>"Could not decline the pickup request. Please try again.",
                'result' => []
            ]), 200);
        }
    }
    
    public function confirm_pickup(Request $request)
    {
        $rider = rider::where('email', $request->user()->email)->first();
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
                    return response(json_encode([
                        'status' =>'success',
                        'message' => "You have confirmed the pickup request with tracking id: '" . $parcel->trackingid . "' for transit.",
                        'result' => []
                    ]), 200);
                }else{
                    return response(json_encode([
                        'status' =>'error',
                        'message' =>"Parcel saved but could not be assigned to you for transit.",
                        'result' => []
                    ]), 200);
                }
            }else{
                return response(json_encode([
                    'status' =>'error',
                    'message' =>"Could not save the pickup as parcel due to an unexpected error! Please try again.",
                    'result' => []
                ]), 200);
            }
        }else{
            return response(json_encode([
                'status' =>'error',
                'message' =>"You do not have the permission to confirm this parcel.",
                'result' => []
            ]), 200);
        }
    }


}
