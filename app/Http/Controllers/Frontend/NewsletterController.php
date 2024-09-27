<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVerification;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
// use Str;

class NewsletterController extends Controller
{
    public function newsLetterRequest(Request $request)
    {
        // Validate the email
        $validation = $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the subscriber already exists
        $existSubscriber = NewsletterSubscriber::where('email', $request->email)->first();

        if (!empty($existSubscriber)) {
            if ($existSubscriber->is_verified == 0) {
                $existSubscriber->verified_token = \Str::random(25);
                $existSubscriber->save();
                // Set mail config
                MailHelper::setMailConfig();
                // Send verification link again
                Mail::to($existSubscriber->email)->send(new SubscriptionVerification($existSubscriber));
                return response(['status' => 'success', 'message' => 'Verification link sent again to your email address. Please verify it.']);
            } elseif ($existSubscriber->is_verified == 1) {
                return response(['status' => 'error', 'message' => 'You are already subscribed.']);
            }
        } else {
            // Save the new subscriber
            $subscriber = new NewsletterSubscriber();
            $subscriber->email = $request->email;
            $subscriber->verified_token = \Str::random(25);
            $subscriber->is_verified = 0;
            $subscriber->save();

            // Set mail config
            MailHelper::setMailConfig();

            // Send verification link to email
            Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));
            return response(['status' => 'success', 'message' => 'Verification link sent to your email address. Please verify it.']);
        }
    }

    public function newsLetterEmailVerify($token)
    {
        $verify=NewsletterSubscriber::where('verified_token', $token)->first();
        if($verify){
            $verify->verified_token= 'verified';
            $verify->is_verified=1;
            $verify->save();
            toastr('Email Verified Successfully', 'success', 'Success');
            return redirect()->route('fronted.home');
        }else{
            toastr('Invalid Token', 'error', 'Error');
            return redirect()->route('fronted.home');
        }
    }
}
