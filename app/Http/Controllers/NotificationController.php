<?php

namespace App\Http\Controllers;

use App\Models\notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function store($msg, $category, $link = null)
    {
        $notify = new notification;
        $notify->link = $link;
        $notify->category = $category;
        $notify->message = $msg;
        $notify->save();
    }

    public function saveNotice($message, $category)
    {
        if ($category == 'pickup') {
            $link = '/pickups';
        } else {
            $link = null;
        }
        
        self::store($message, $category, $link);
    }
}
