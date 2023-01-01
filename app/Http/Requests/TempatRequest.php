<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TempatRequest extends FormRequest
{
    public function rules()
    {
        return [
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
        ];
    }

    public function messages()
    {
        return [
            'latitude.required' => 'latitude tidak boleh kosong',
            'longitude.required' => 'longitude tidak boleh kosong',
            'nama_tempat.required' => 'nama tempat tidak boleh kosong',
            'alamat.required' => 'alamat tidak boleh kosong',
        ];
    }
}
