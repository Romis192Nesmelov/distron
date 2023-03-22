<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    use HelperTrait;

    public function sendRequest(Request $request)
    {
        return $this->sendMessage('feedback', $this->validate($request, $this->getRequestValidation()), $request);
    }

    public function sendShortRequest(Request $request)
    {
        return $this->sendMessage('feedback', $this->validate($request, ['phone' => $this->validationPhone,'i_agree' => 'required|accepted']), $request);
    }

    public function sendMessage($template, array $fields, Request $request)
    {
        Mail::send('emails.'.$template, $fields, function($message) {
            $message->subject('Сообщение с сайта '.env('APP_NAME'));
            $message->to(env('MAIL_TO'));
        });
        $message = trans('content.we_will_contact_you');
        return $request->ajax()
            ? response()->json(['success' => true, 'message' => $message])
            : redirect()->back()->with('message', $message);
    }
}
