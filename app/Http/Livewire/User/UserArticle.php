<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Auth;

class UserArticle extends Component
{
    public function render()
    {
        return view('livewire.user.user-article');
    }

    public function userLogout(){
        Auth::logout();
        session()->flash('message', 'Başarıyla çıkış Yapıldı.');
        return redirect()->route('welcome');
    }
}
