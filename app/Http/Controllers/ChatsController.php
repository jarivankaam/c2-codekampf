<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class ChatsController extends Controller{
    public function fetchMessages(Request $request){
        if (RateLimiter::tooManyAttempts('send-message:'.$request->ip(), $perMinute = 100)) {
            return ['status' => 'Too many requests sent!', 'statusCode' => 429];
        }

        $messages = Message::all()->take(50);
        return ['status' => 'success', 'statusCode' => 200, 'messages' => $messages];
    }

    public function saveMessage(Request $request){
        if (RateLimiter::tooManyAttempts('send-message:'.$request->ip(), $perMinute = 100)) {
            return ['status' => 'Too many requests sent!', 'statusCode' => 429];
        }

        $message = new Message();
        $message->uuid = $request->input('uuid');
        $message->content = $request->input('content');
        $message->save();

        return ['status' => 'success', 'statusCode' => 200];
    }
}
