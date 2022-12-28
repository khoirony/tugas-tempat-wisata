<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempat;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function tambahTempat()
    {
        $tempats = Tempat::all();
        // dd($tempats);
        return view('admin.tambahtempat',[
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
        ]);

        Tempat::create($tempat);
        return redirect('/listtempat')->with('success', 'Tempat baru berhasil ditambahkan!');
    }

    public function listTempat()
    {
        $tempats = Tempat::all();
        // dd($tempats);
        return view('admin.listtempat',[
            'tempats' => $tempats
        ]);
    }

    public function detailTempat($id)
    {
        $tempat = Tempat::find($id);
        
        return view('admin.detailtempat',[
            'tempat' => $tempat
        ]);
    }

    public function editTempat($id)
    {
        $detailtempat = Tempat::find($id);
        
        return view('admin.edittempat',[
            'tempat' => $detailtempat
        ]);
    }

    public function updateTempat(Request $request, $id)
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
        ]);
        Tempat::query()->where('id', $id)->update($tempat);

        return redirect('/detailtempat/'.$id)->with('success', 'Tempat berhasil diperbarui!');
    }

    public function hapustempat($id)
    {
        $tempat = Tempat::where('id', $id)->delete();
        return redirect('/listtempat')->with('success', 'Tempat berhasil dihapus');
    }
}
