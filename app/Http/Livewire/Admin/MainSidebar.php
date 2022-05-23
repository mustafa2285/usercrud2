<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Auth;

class MainSidebar extends Component
{
    public function render()
    {
        return view('livewire.admin.main-sidebar');
    }
    public function userLogout(){
        Auth::logout();
        session()->flash('message', 'Başarıyla çıkış Yapıldı.');
        return redirect()->route('login');
    }
}
