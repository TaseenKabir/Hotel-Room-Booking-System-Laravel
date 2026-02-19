<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class RoomTypeController extends Controller
{
    public function index() {
        $trashedCount = RoomType::onlyTrashed()->count();
        return view('admin.room-types', compact('trashedCount'));
    }

    public function trashCount()
    {
        $count = RoomType::onlyTrashed()->count();
        return response()->json(['count' => $count]);
    }

    //Store room type
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png|max:2048',
            'name' => 'required|unique:room_types',
            'price' => 'required',
            'description' => 'required'
        ], [
            'name.required' => 'Name is required!',
            'name.unique' => 'Name already exists!',
            'price.required' => 'Price is required!',
            'description.required' => 'Description is required!'
        ]);

        $roomType = new RoomType();
        $roomType->name = $request->name;
        $roomType->description = $request->description;
        $roomType->price = $request->price;
        $roomType->max_capacity = $request->max_capacity;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '.'  . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $imagePath = $destinationPath . '/' . $fileName;
            $image->move($destinationPath, $fileName);
            $roomType->image = $fileName;
        }
        $save = $roomType->save();

        if ($save) {
            return response()->json(['status' => 1, 'message' => 'New room type has been successfully added!']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong...']);
        }
    } //End method

    //Display the room type in ajax table
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = RoomType::orderBy('id', 'asc')
                ->select(['id', 'image', 'name', 'description', 'price', 'max_capacity']);

            return DataTables::of($data)
                ->addColumn('actions', function ($row) {
                    return '<div class="btn-group">
                                <button type="button" class="text-dark mx-2" data-id="' . $row['id'] . '" id="editRoomBtn">
                                    <i class="fa fa-edit" title="Edit"></i>
                                </button>

                                <button type="button" class="text-dark mx-2 deleteRoomBtn" 
                                    data-id="' . $row['id'] . '">
                                    <i class="fa fa-trash" title="Delete"></i>
                                </button>
                            </div>';
                })
                ->addColumn('image', function ($row) {
                    return '<img src="' . asset("images/" . $row->image) . '" width="50" height="50" />';
                })

                ->rawColumns(['actions', 'image'])

                ->make(true);
        }
    } //End method

    //Edit the product data
    public function edit(Request $request){
        $room_type_id = $request->id;
        $roomType = RoomType::findOrFail($room_type_id);
        return response()->json(['data'=>$roomType]);
    }


    //End method

    //Update the edited product data
    public function update(Request $request)
    {
        $roomType = RoomType::findOrFail($request->id);

        // Validate
        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png|max:2048',
            'name' => 'required|unique:room_types,name' . $roomType->id,
            'price' => 'required',
            'description' => 'required'
        ], [
            'name.required' => 'Name is required!',
            'name.unique' => 'Name already exists!',
            'price.required' => 'Price is required!',
            'description.required' => 'Description is required!'
        ]);

        // Update fields
        $roomType->name = $request->name;
        $roomType->description = $request->description;
        $roomType->price = $request->price;
        $roomType->max_capacity = $request->max_capacity;

        // Handle image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/images'), $fileName);
            $roomType->image = $fileName;
        }

        $save = $roomType->save();

        if ($save) {
            return response()->json([
                'status' => 1,
                'message' => 'Product info has been updated successfully!'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Something went wrong...'
            ]);
        }
    }
    //End method

    public function delete(Request $request)
    {
        $roomType = RoomType::findOrFail($request->id);
        $del = $roomType->delete();

        if ($del) {
            return response()->json(['status' => 1, 'message' => 'Product has been successfully 
            deleted from the list!']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong...']);
        }
    } //End method

    public function restore(Request $request)
    {
        $roomType = RoomType::onlyTrashed()->find($request->id);

        $roomType->restore();

        return redirect()->route('rooms.types');
    } //End method


    public function forceDelete(Request $request)
    {
        $roomType = RoomType::onlyTrashed()->findOrFail($request->id);

        // delete image if exists
        if ($roomType->image && File::exists(public_path('images/' . $roomType->image))) {
            File::delete(public_path('images/' . $roomType->image));
        }

        $roomType->forceDelete();

        return redirect()->route('room-type.trash')->with('success','Room type has been successfully deleted.');
    }

    public function trash()
    {
        $roomTypes = RoomType::onlyTrashed()
            ->latest()
            ->get();

        return view('admin.room-type-trash', compact('roomTypes'));
    }
}
