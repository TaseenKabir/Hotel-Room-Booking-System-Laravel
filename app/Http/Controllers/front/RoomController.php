<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function roomDetails($id)
    {
        $room = RoomType::find($id);

        return view('room-details', compact('room'));
    }

    public function roomPage()
    {
        $rooms = RoomType::all();
        return view('room-page', compact('rooms'));
    }


    public function searchRooms(Request $request) {
        
        if ($request->ajax()) {

            $output = '';

            $rooms = RoomType::where('name', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('price', 'LIKE', '%'.$request->search.'%')
                                ->orWhere('max_capacity', 'LIKE', '%'.$request->search.'%')
                                ->get();
            if ($rooms) {
                foreach($rooms as $room) {
                    $output .= 
                    '<div class="col-md-4 col-sm-6">
                        <div id="serv_hover"  class="room">

                            <div class="room_img">
                                <figure><img src="'.asset('images/'.$room->image).'"></figure>
                            </div>
                            <div class="bed_room">
                                <h3>'.$room->name.'</h3>
                                <h4>'.$room->price.' /-'.'</h4>
                                <p>'.\Illuminate\Support\Str::limit($room->description, 100).'</p>
                                <a href="'.route('room.details', $room->id).'" 
                                    class="btn btn-primary mt-2">
                                    Book Now
                                </a>
                            </div>
                            
                        </div>
                    </div>';
                }

                return response()->json($output);
            }
        }

        return view('room-page');
    }

    
}
