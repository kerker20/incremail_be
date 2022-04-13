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
        // $to = $request->input('recipient');
        // $template = $request->input('html');

        Mail::send([], $mail_data, function (Message $message) use ($mail_data) {
            $message->to($mail_data['recipient'])
        ->subject($mail_data['subject'])
        ->from('renalybengil@gmail.com', $mail_data['fromName'])
        ->setBody($mail_data['template'], 'text/html');
});

        return response([
            'to' => $mail_data['fromName'],
            'message' => 'Successfully sent!',
        ]);
    }
}
