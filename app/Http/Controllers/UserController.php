<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempat;
use App\Models\User;
use App\Models\Komentar;
use App\Models\Favorite;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $tempats = Tempat::all();
        return view('user.dashboard',[
            'title' => 'Dashboard User',
            'tempats' => $tempats
        ]);
    }

    public function listTempat()
    {
        $tempats = Tempat::select('tempats.*', Komentar::raw('COALESCE(AVG(komentars.rating), 0) as rating'))
        ->leftjoin('komentars', 'komentars.id_tempat', '=', 'tempats.id')
        ->orderBy('rating', 'desc')
        ->groupBy('tempats.id')
        ->get();
        
        return view('admin.listtempat',[
            'title' => 'List Tempat Wisata',
            'tempats' => $tempats
        ]);
    }

    public function listFav()
    {
        $favorites = Tempat::select('tempats.*', Komentar::raw('COALESCE(AVG(komentars.rating), 0) as rating'),'favorites.status')
        ->leftjoin('favorites', 'favorites.id_tempat', '=', 'tempats.id')
        ->leftjoin('komentars', 'komentars.id_tempat', '=', 'tempats.id')
        ->orderBy('rating', 'desc')
        ->groupBy('tempats.id')
        ->groupBy('favorites.id')
        ->where('favorites.id_user', Auth::user()->id)
        ->get();
        
        return view('admin.listfavorite',[
            'title' => 'List Tempat Wisata',
            'tempats' => $favorites
        ]);
    }

    public function detailTempat($id)
    {
        $tempat = Tempat::find($id);
        $rating = Tempat::join('komentars', 'komentars.id_tempat', '=', 'tempats.id')->where('komentars.id_tempat', $id)->avg('komentars.rating');
        
        return view('admin.detailtempat',[
            'title' => 'Detail '.$tempat->nama_tempat,
            'tempat' => $tempat,
            'cekfoto' => 0,
            'rating' => $rating
        ]);
    }

    public function cariTempat(Request $request)
    {
        if(isset($request)) {
            $tempat = Tempat::where('nama_tempat','ilike', "%{$request->input('cari')}%")->get();
        }else{
            $tempat = Tempat::all();
        }
        
        return view('admin.caritempat',[
            'title' => 'Cari Tempat',
            'tempats' => $tempat
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
            'profpic' => 'nullable|image'
        ]);

        if($request->file("profpic") != null){
            // get input file
            $file = $request->file("profpic");
            // hash file name
            $filename = $file->hashName();
            // move file to folder profpic
            $file->move("profpic", $filename);
            // initiate folder name + filename to path
            $path = "/profpic/" . $filename;

            $user['profpic'] = $path;
        }
        User::query()->where('id', Auth::user()->id)->update($user);

        return redirect('/user/profile')->with('success', 'Akun berhasil diperbarui!');
    }
}
