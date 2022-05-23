<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Pagination\Paginator;

class Controller extends BaseController
{
    protected $paginationTheme = 'bootstrap';
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function k()
    {
        Paginator::useBootstrap();
        $users = User::withCount('articles')->paginate(5);
        return view('welcome',compact('users'));
    }
}
