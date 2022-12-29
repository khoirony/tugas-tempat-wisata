<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use App\Models\Komentar as Komen;
use Auth;

class Komentar extends Component
{
    public $id_komentar;
    public $id_tempat;
    public $isi_komentar;
    public $showDiv = false;

    protected $rules = [
        'isi_komentar' => 'required',
    ];

    public function submit()
    {
        $this->validate();
 
        // dd($this->komentar, $this->id_tempat);
        // Execution doesn't reach here if validation fails.
        Komen::create([
            'id_tempat' => $this->id_tempat,
            'isi_komentar' => $this->isi_komentar,
            'id_user' => Auth::user()->id,
            'rating' => 5
        ]);
    }

    public function render()
    {
        $komen = Komen::where('id_tempat', $this->id_tempat)->orderBy('created_at', 'desc')->get();
        return view('livewire.form.komentar',['komen' => $komen]);
    }

    public function openDiv()
    {
        $this->showDiv =! $this->showDiv;
    }

    public function delete($id)
    {
        Komen::where('id', $id)->delete();
    }
}
