<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempat;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.dashboard',[
            'title' => 'Dashboard User',
        ]);
    }

    public function listTempat()
    {
        $tempats = Tempat::all();
        
        return view('admin.listtempat',[
            'title' => 'List Tempat Wisata',
            'tempats' => $tempats
        ]);
    }

    public function detailTempat($id)
    {
        $tempat = Tempat::find($id);
        
        return view('admin.detailtempat',[
            'title' => 'Detail '.$tempat->nama_tempat,
            'tempat' => $tempat
        ]);
    }

    public function profile()
    {
        $tempats = Tempat::all();
        $user = user::find(Auth::user()->id);
        
        return view('admin.detailuser',[
            'title' => $user->name,
            'tempats' => $tempats,
            'user' => $user
        ]);
    }

    public function editProfile()
    {
        $user = user::find(Auth::user()->id);
        $tempats = Tempat::all();
        
        return view('admin.edituser',[
            'title' => 'Edit '. $user->name,
            'tempats' => $tempats,
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'jk' => 'required',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'alamat' => 'nullable',
            'bio' => 'nullable',
        ]);
        User::query()->where('id', Auth::user()->id)->update($user);

        return redirect('/user/profile')->with('success', 'Akun berhasil diperbarui!');
    }
}
