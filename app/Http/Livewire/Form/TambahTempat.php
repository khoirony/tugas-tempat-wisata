<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use App\Models\Tempat;

class TambahTempat extends Component
{
    public $latitude;
    public $longitude;
    public $nama_tempat;
    public $alamat;
 
    protected $rules = [
        'latitude' => 'required',
        'longitude' => 'required',
        'nama_tempat' => 'required',
        'alamat' => 'required',
    ];
 
    public function submit()
    {
        $this->validate();
 
        // Execution doesn't reach here if validation fails.
        dd($this->latitude,$this->longitude,$this->nama_tempat,$this->alamat);
        
        Tempat::create([
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'nama_tempat' => $this->nama_tempat,
            'alamat' => $this->alamat,
        ]);
        return redirect('/list-tempat');
    }

    public function render()
    {
        return view('livewire.form.tambah-tempat');
    }
}
