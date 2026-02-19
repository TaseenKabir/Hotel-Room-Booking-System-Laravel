<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $rooms = RoomType::latest()->limit(3)->get();
        return view('home.index', compact('rooms'));
    }
}
