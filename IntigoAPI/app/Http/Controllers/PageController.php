<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Creator;
use App\Models\Meeting;

class PageController extends Controller
{
    public function welcome() {
        $creators = Creator::all();
        $meetings = Meeting::all();
        return view('welcome', compact('creators', 'meetings'));
    }
}
