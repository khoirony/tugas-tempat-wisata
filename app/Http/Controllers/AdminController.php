<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempat;
use App\Models\FotoTempat;
use App\Models\User;
use App\Models\Komentar;

class AdminController extends Controller
{
    public function index()
    {
        $tempats = Tempat::all();
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
        $tempat = Tempat::find($id);

        $rating = Tempat::join('komentars', 'komentars.id_tempat', '=', 'tempats.id')->where('komentars.id_tempat', $id)->avg('komentars.rating');

        // dd($rating);
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

    public function tambahTempat()
    {
        $tempats = Tempat::all();
        // dd($tempats);
        return view('admin.tambahtempat',[
            'title' => 'Tambah Tempat Wisata',
            'tempats' => $tempats
        ]);
    }

    public function storeTempat(Request $request)
    {
        $tempat = $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'nama_tempat' => 'required',
            'alamat' => 'required',
            'deskripsi' => 'nullable',
            'hari_buka' => 'nullable',
            'hari_tutup' => 'nullable',
            'jam_buka' => 'nullable',
            'jam_tutup' => 'nullable',
            'harga_tiket' => 'nullable',
            'foto_tempat' => 'nullable'
        ]);

        Tempat::query()->create([
            'latitude' => $tempat['latitude'],
            'longitude' => $tempat['longitude'],
            'nama_tempat' => $tempat['nama_tempat'],
            'alamat' => $tempat['alamat'],
            'deskripsi' => $tempat['deskripsi'],
            'hari_buka' => $tempat['hari_buka'],
            'hari_tutup' => $tempat['hari_tutup'],
            'jam_buka' => $tempat['jam_buka'],
            'jam_tutup' => $tempat['jam_tutup'],
            'harga_tiket' => $tempat['harga_tiket'],
        ]);

        if($request->file("foto_tempat") != null){
            foreach($request->file("foto_tempat") as $foto){
                // dd($foto->hashname);
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
        $tempat = Tempat::find($id);
        
        return view('admin.edittempat',[
            'title' => 'Edit '.$tempat->nama_tempat,
            'tempat' => $tempat
        ]);
    }

    public function updateTempat(Request $request, $id)
    {
        // dd($request->file("foto_tempat"));
        $tempat = $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'nama_tempat' => 'required',
            'alamat' => 'required',
            'deskripsi' => 'nullable',
            'hari_buka' => 'nullable',
            'hari_tutup' => 'nullable',
            'jam_buka' => 'nullable',
            'jam_tutup' => 'nullable',
            'harga_tiket' => 'nullable',
            'foto_tempat' => 'nullable'
        ]);


        Tempat::query()->where('id', $id)->update([
            'latitude' => $tempat['latitude'],
            'longitude' => $tempat['longitude'],
            'nama_tempat' => $tempat['nama_tempat'],
            'alamat' => $tempat['alamat'],
            'deskripsi' => $tempat['deskripsi'],
            'hari_buka' => $tempat['hari_buka'],
            'hari_tutup' => $tempat['hari_tutup'],
            'jam_buka' => $tempat['jam_buka'],
            'jam_tutup' => $tempat['jam_tutup'],
            'harga_tiket' => $tempat['harga_tiket'],
        ]);

        if($request->file("foto_tempat") != null){

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
        $tempats = Tempat::all();
        $users = User::where('role', 2)->get();

        return view('admin.listuser',[
            'title' => 'List User',
            'tempats' => $tempats,
            'users' => $users
        ]);
    }

    public function detailUser($id)
    {
        $tempats = Tempat::all();
        $user = user::find($id);
        
        return view('admin.detailuser',[
            'title' => 'Detail '. $user->name,
            'tempats' => $tempats,
            'user' => $user
        ]);
    }

    public function editUser($id)
    {
        $user = user::find($id);
        $tempats = Tempat::all();
        
        return view('admin.edituser',[
            'title' => 'Edit '. $user->name,
            'tempats' => $tempats,
            'user' => $user
        ]);
    }

    public function updateUser(Request $request, $id)
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
