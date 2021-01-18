<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function fetch(Request $request)
    {
        if($request->filter == 'all'){
            $contacts = contact::orderBy('created_at', 'DESC')->get();
        }else{
            $contacts = contact::where('status', $request->filter)->orderBy('created_at', 'DESC')->get();
        }
        return $contacts;
    }

    public function update(Request $request)
    {
        $contact = contact::findOrFail($request->id);
        $contact->status = $request->status;
        $contact->update();
        return json_encode(['status' => 'success']);
    }
}
