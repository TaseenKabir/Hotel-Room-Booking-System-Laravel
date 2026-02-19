<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function confirmBook(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
        ]);
        if ($validator->passes()) {
            $data = new Booking();
            $data->room_type_id = $id;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->total_amount = $request->total_amount;

            $checkIn = $request->check_in;
            $checkOut = $request->check_out;
            $isBooked = Booking::where('room_type_id',$id)
                        ->where('check_in','<=',$checkOut)
                        ->where('check_out','>=',$checkIn)->exists();

            if ($isBooked) {
                return redirect()->back()
                        ->with('error', 'Room is already booked!Try a different date.')
                        ->withInput();
            } else {
                $data->check_in = $request->check_in;
                $data->check_out = $request->check_out;
                $data->save();

                return redirect()->back()->with('success', 'Booking completed successfully!');
            }
           
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }
        
    }
}
