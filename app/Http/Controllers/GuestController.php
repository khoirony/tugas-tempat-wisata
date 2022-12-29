<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempat;

class GuestController extends Controller
{
    public function index()
    {
        $tempats = Tempat::all();
        
        return view('welcome',[
            'title' => 'Selamat Datang Di Travelers',
            'tempats' => $tempats
        ]);
    }
}
