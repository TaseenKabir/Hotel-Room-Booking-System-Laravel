<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('search')) {
            $query->where('message', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->search . '%');
        }

        $data = $query->paginate(5)->withQueryString();

        return view('admin.message', compact('data'));
    }

    public function email($id) {
        $data = Contact::find($id);
        return view('admin.email', compact('data'));
    }

    public function send(Request $request,$id) {
        $data = Contact::find($id);

        $details = [
            'greeting' => $request->greeting,
            'mail_body' => $request->mail_body,
            'action_text' => $request->action_text,
            'action_url' => $request->action_url,
            'end_line' => $request->end_line
        ];

        Notification::send($data,new SendEmailNotification($details));

        return redirect()->back();
        
    }
}
