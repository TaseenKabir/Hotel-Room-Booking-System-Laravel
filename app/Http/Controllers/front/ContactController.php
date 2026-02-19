<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() {
        return view('home.contact');
    }
    public function message(Request $request) {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $save = $contact->save();
        if ($save) {
            return response()->json(['status' => 1, 'message' => 'Message has been successfully sent!']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong...']);
        }

        
    }
}
