<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Auth;

class UserNavbar extends Component
{
    public function render()
    {
        return view('livewire.user.user-navbar');
    }

    public function userLogout(){
        Auth::logout();
        session()->flash('message', 'Başarıyla çıkış Yapıldı.');
        return redirect()->route('welcome');
    }
}
