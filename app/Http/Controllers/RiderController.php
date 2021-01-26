<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\rider;
use App\Models\branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

class RiderController extends Controller
{
    public function add(Request $request)
    {
        if($request->hasFile('image')){ //If request have image
            //get Image
            $image = $request->file('image');
            //Get the Original File Name and path
            $thumbnail = $request->file('image')->getClientOriginalName();
            //Get the filename only using native php 'pathinfo'
            $filename = pathinfo($thumbnail, PATHINFO_FILENAME);
            //Extract the Extension
            $ext = strtolower($request->file('image')->getClientOriginalExtension());
            //prepare the file to be stored
            $nameToStore = $filename . '_'. time() .'.'. $ext;
            //upload the file
            $image_resize = Image::make($image->getRealPath());
            // To resize the image to a width of 600 and constrain aspect ratio (auto height)
            $image_resize->resize(600,  null, function ($constraint) {
                $constraint->aspectRatio();
                });
            $image_resize->orientate();
            if($image_resize->save(storage_path('app/public/images/riders/'.$nameToStore))){
                $rider = new rider;
                $rider->firstname = $request->fname;
                $rider->lastname = $request->lname;
                $rider->phone = $request->phone;
                $rider->email = $request->email;
                $rider->plate_number = $request->plate_no;
                $rider->photo = $nameToStore;
                $rider->motorcycle = $request->details;
                $rider->branch_id = $request->branch;
                if($rider->save()){
                    $createuser = $this->NewUser($rider->firstname, $rider->lastname, $rider->phone, $rider->email );
                    return json_encode([
                        'status' => 'success',
                        'rider_id' => $rider->id,
                        'message' => 'Rider information stored successfully'
                    ]);
                }else{
                    unlink(storage_path('app/public/images/riders/'.$nameToStore));
                    return json_encode([
                        'status' => 'error',
                        'message' => 'Unable to save riders details'
                    ]);
                }
            }else{
                return json_encode([
                    'status' => 'error',
                    'message' => 'An unexpected error occured while trying to save image file'
                ]);
            }
        }else{
            return json_encode([
                'status' => 'error',
                'message' => 'Image file not found'
            ]);
        }
        return $request;
    }

    public function NewUser($fname, $lname, $phone, $email)
    {
        if(!User::where('email', $email)->orWhere('phone', $phone)->exists()){
            return User::create([
                'firstname' => $fname,
                'lastname' => $lname !='' ? $lname : null,
                'phone' => $phone,
                'email' => $email,
                'usertype' => '1',
                'password' => Hash::make('12345678'),
            ]);
        }
    }

    public function fetch(Request $request)
    {
        // Check if there is a filter and filter the query
        if($request->filter == ''){
            $riders = rider::orderBy('firstname', 'ASC')->get();
        }else{
            $riders = rider::where('firstname', 'like', '%' . $request->filter . '%')
            ->orWhere('lastname', 'like', '%' . $request->filter . '%')
            ->orWhere('plate_number', 'like', '%' . $request->filter . '%')
            ->orderBy('firstname', 'ASC')->get();
        }
        
        foreach ($riders as $rider) {
            $rider->branch = $rider->branch;
        }
        return $riders;
    }

    public function fetch_all(Request $request)
    {
        $branches = branch::all();
        return $branches;
    }
}
