<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Pagination\Paginator;
use App\Models\User;

class Homepage extends Component
{
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        Paginator::useBootstrap();
        $users = User::withCount('articles')->paginate(5);
        return view('livewire.user.homepage',compact('users'));
    }
}
