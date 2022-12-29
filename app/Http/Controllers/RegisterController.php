<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Tempat;

class RegisterController extends Controller
{
    public function index(){
        $tempats = Tempat::all();

        return view('auth.register', [
            'tempats' => $tempats,
            'title' => 'Register',
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 2;

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registration successfull Please Login');
    }
}
