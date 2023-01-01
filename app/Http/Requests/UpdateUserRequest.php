<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'jk' => 'required',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'alamat' => 'nullable',
            'bio' => 'nullable',
            'profpic' => 'nullable|image'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Lengkap tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'jk.required' => 'Jenis Kelamin tidak boleh kosong',
            'profpic.image' => 'Foto Profil harus berupa gambar',
        ];
    }
}
