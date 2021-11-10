<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class ChatsController extends Controller{
    public function fetchMessages(Request $request){
        $executed = RateLimiter::attempt(
            'send-message:'.base64_encode($request->getClientIp()),
            $perMinute = 5,
            function() {
                return true;
            }
        );

        if (!$executed) {
            return ['status' => 'Too many requests sent!', 'statusCode' => 429];
        }else{
            $messages = Message::all()->take(50);
            return ['status' => 'success', 'statusCode' => 200, 'messages' => $messages];
        }
    }

    public function saveMessage(Request $request){
        $statusCode = RateLimiter::attempt(
            'send-message:'.base64_encode($request->getClientIp()),
            $perMinute = 5,
            function() use ($request) {
                $uuid = $request->input('uuid');
                $content = $request->input('content');

                if(strlen($content) < 1){
                    return 411;
                }

                if(strlen($content) > 250){
                    return 406;
                }

                $message = new Message();
                $message->uuid = $uuid;
                $message->content = $content;
                $message->save();

                $this->errorCode = 200;
                return 200;
            }
        );

        if ($statusCode == 406){
            return ['status' => 'Too many characters! Max 250', 'statusCode' => 406];
        }elseif($statusCode == 411){
            return ['status' => 'Can not send empty message', 'statusCode' => 411];
        }elseif($statusCode == 200){
            return ['status' => 'success', 'statusCode' => 200];
        }elseif($statusCode == false){
            return ['status' => 'Too many requests sent!', 'statusCode' => 429];
        }else{
            return ['status' => 'Internal server error', 'statusCode' => 500];
        }
    }
}
