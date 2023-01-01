<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TempatRequest;
use App\Http\Requests\UpdateUserRequest;

use App\Models\Tempat;
use App\Models\FotoTempat;
use App\Models\User;
use App\Models\Komentar;

class AdminController extends Controller
{
    public function index()
    {
        // get data tempat untuk marker
        $tempats = Tempat::all();

        // get jumlah
        $jmltempats = Tempat::count();
        $jmlusers = User::count();
        $jmlkomentars = Komentar::count();

        return view('admin.dashboard',[
            'title' => 'Dashboard Admin',
            'jmltempat' => $jmltempats,
            'jmluser' => $jmlusers,
            'jmlkomentar' => $jmlkomentars,
            'tempats' => $tempats
        ]);
    }

    // CRUD TEMPAT
    public function listTempat()
    {
        // get data tempat sort rating terbaik
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

    public function detailTempat($id)
    {
        // get data detail tempat
        $tempat = Tempat::find($id);
        // get data total rating tempat
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
        // cek request cari, jika ada get data sesuai pencarian
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

    public function tambahTempat()
    {
        // get data for marker
        $tempats = Tempat::all();
        
        return view('admin.tambahtempat',[
            'title' => 'Tambah Tempat Wisata',
            'tempats' => $tempats
        ]);
    }

    public function storeTempat(TempatRequest $request)
    {
        // insert request to tabel tempat (kecuali foto_tempat)
        $tempat = $request->except('foto_tempat');
        Tempat::query()->create($tempat);

        // cek input file
        if($request->file("foto_tempat") != null){
            // looping multiple files
            foreach($request->file("foto_tempat") as $foto){
                $filename = $foto->hashName();
                // move file to folder tempat
                $foto->move("tempat", $filename);
                // initiate folder name + filename to path
                $path = "/tempat/" . $filename;
                // get id tempat
                $id_tempat = Tempat::orderBy('id', 'desc')->first();
                
                // insert foto
                FotoTempat::query()->create([
                    'id_tempat' => $id_tempat->id,
                    'nama_foto' => $path
                ]);
            }
        }

        return redirect('/listtempat')->with('success', 'Tempat baru ditambahkan!');
    }

    public function editTempat($id)
    {
        // get data for marker
        $tempat = Tempat::find($id);
        
        return view('admin.edittempat',[
            'title' => 'Edit '.$tempat->nama_tempat,
            'tempat' => $tempat
        ]);
    }

    public function updateTempat(TempatRequest $request, $id)
    {
        // insert request to update tabel tempat (kecuali foto_tempat)
        $tempat = $request->except('foto_tempat', '_token');
        Tempat::query()->where('id', $id)->update($tempat);

        // cek input file
        if($request->file("foto_tempat") != null){
            // looping multiple files
            foreach($request->file("foto_tempat") as $foto){
                // dd($foto->hashname);
                $filename = $foto->hashName();
                // move file to folder tempat
                $foto->move("tempat", $filename);
                // initiate folder name + filename to path
                $path = "/tempat/" . $filename;
                // get id tempat
                $id_tempat = Tempat::where('id', $id)->first();
        
                // insert foto tempat
                FotoTempat::query()->create([
                    'id_tempat' => $id_tempat->id,
                    'nama_foto' => $path
                ]);
            }
        }

        return redirect('/detailtempat/'.$id)->with('success', 'Tempat berhasil diperbarui!');
    }

    public function hapustempat($id)
    {
        $tempat = Tempat::where('id', $id)->delete();
        return redirect('/listtempat')->with('success', 'Tempat berhasil dihapus');
    }

    // CRUD USER
    public function listUser()
    {
        // get data for marker
        $tempats = Tempat::all();
        // get list user where role 2
        $users = User::where('role', 2)->get();

        return view('admin.listuser',[
            'title' => 'List User',
            'tempats' => $tempats,
            'users' => $users
        ]);
    }

    public function detailUser($id)
    {
        // get data for marker
        $tempats = Tempat::all();
        // get detail data user
        $user = user::find($id);
        
        return view('admin.detailuser',[
            'title' => 'Detail '. $user->name,
            'tempats' => $tempats,
            'user' => $user
        ]);
    }

    public function editUser($id)
    {
        // get data for marker
        $tempats = Tempat::all();
        // get detail data user
        $user = user::find($id);
        
        return view('admin.edituser',[
            'title' => 'Edit '. $user->name,
            'tempats' => $tempats,
            'user' => $user
        ]);
    }

    public function updateUser(UpdateUserRequest $request, $id)
    {
        // form validation update user
        $user = $request->except('_token');

        // check file input
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

        // update table user
        User::query()->where('id', $id)->update($user);

        return redirect('/detailuser/'.$id)->with('success', 'User berhasil diperbarui!');
    }

    public function hapusUser($id)
    {
        $user = User::where('id', $id)->delete();
        return redirect('/listuser')->with('success', 'User berhasil dihapus');
    }

    public function hapusFoto($id)
    {
        $foto = FotoTempat::where('id', $id)->delete();
        return back()->with('success', 'Foto berhasil dihapus');
    }
}
