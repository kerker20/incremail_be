<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    
    public function sendMail(Request $request) {
        $mail_data = [
            'recipient' => $request->recipient,
            'template' => $request->html,
            'subject' => $request->subject,
            'fromName' => $request->fromName,
        ];
        

        $cc = explode(',',$mail_data['recipient']);

        

        Mail::send([], $mail_data, function (Message $message) use ($mail_data, $cc) {
            $message->to($cc)
        ->subject($mail_data['subject'])
        ->from('renalybengil@gmail.com', $mail_data['fromName'])
        ->setBody($mail_data['template'], 'text/html');

        
        });

        return response([
            'to' => $mail_data['fromName'],
            'message' => 'Successfully sent!',
            'data' => $cc
        ]);
    }
}
