<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookings() {
        $data = Booking::all();
        return view('admin.booking', compact('data'));
    }

    public function destroy($id) {
        $data = Booking::find($id);
        $data->delete();

        return redirect()->back();
    }
}
