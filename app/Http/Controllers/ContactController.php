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

    public function store(Request $request)
    {
        $contact = new contact;
        $contact->fulname = $request->fname;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        if($contact->save()){
            return json_encode([
                'status' => 'success',
                'message' => 'Thank you for the feedback! We will get back to you soon!'
            ]);
        }else{
            return json_encode([
                'status' => 'error',
                'message' => 'An unexpected error occured! Please try again!'
            ]);
        }
    }
}
