<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\NewsletterSubscriberDataTable;
use App\Http\Controllers\Controller;
use App\Mail\Newsletter;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Helper\MailHelper;

class SubscribersController extends Controller
{
    public function index(NewsletterSubscriberDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.subscriber.index');
    }

    /**
     * Send Email to all subscribers
     */
    public function sendMail(Request $request)
    {
        $validation = $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);
        $subscribers = NewsletterSubscriber::where('is_verified', 1)->pluck('email')->toArray();
        MailHelper::setMailConfig();
        Mail::to($subscribers)->send(new Newsletter($request->subject, $request->message));
        toastr('Email sent successfully to all subscribers.', 'success', 'Success');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $subscriber=NewsletterSubscriber::findOrFail($id);
        $subscriber->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
