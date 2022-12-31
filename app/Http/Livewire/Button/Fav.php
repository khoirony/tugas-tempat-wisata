<?php

namespace App\Http\Livewire\Button;

use Livewire\Component;
use App\Models\Favorite;
use Auth;

class Fav extends Component
{
    public $id_tempat;
    public $data;
    public $status = false;

    public function fav($id_tempat){
        $fav = Favorite::where('id_tempat', $this->id_tempat)->where('id_user', Auth::user()->id)->first();
        
        if($fav != null){
            Favorite::where('id_tempat', $this->id_tempat)->where('id_user', Auth::user()->id)->delete();
        }else{
            Favorite::create([
                'id_tempat' => $this->id_tempat,
                'id_user' => Auth::user()->id,
                'status' => true,
            ]);
        }
    }

    public function render()
    {
        $this->data = Favorite::where('id_tempat', $this->id_tempat)->where('id_user', Auth::user()->id)->first();

        if ($this->data) {
            $this->status = true;
        }else{
            $this->status = false;
        }

        return view('livewire.button.fav', ['status' => $this->status]);
    }
}
