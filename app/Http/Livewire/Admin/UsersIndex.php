<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UsersIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $user_search;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $user_id;

    public $rules = [
        'name' => 'required|min:2',
        'email' => 'required|min:2|email:rfc,dns',
        'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'required|min:6',
        ];



    public function render()
    {
        $users = User::when($this->user_search, function($query, $search){
            return $query->where('name', 'LIKE',"%$search%");
        })->paginate(5);
        return view('livewire.admin.users-index', compact('users'));
    }

    public function newUser(){
        $this->validate(['email' => 'required|min:2|email:rfc,dns|unique:users']);

        $new = new User();
        $new->name = $this->name;
        $new->email = $this->email;
        $new->password = bcrypt($this->password);
        $new->save();
        $this->reset();

        $this->emit('add-user');

        session()->flash('message', 'Kullanıcı Başarıyla Eklendi');
    }

    public function getUser(User $user){
        $this->name = $user->name;
        $this->email = $user->email;
        $this->user_id = $user->id;
    }

    public function updateUser(){
        $this->validate();

        $user = User::where('id',$this->user_id)->first();
        $user->name = $this->name;
        $user->email = $this->email;
        if (!empty($this->password)){
            $user->password = bcrypt($this->password);
        }
        $user->save();
        $this->reset();
        $this->emit('update-user');

        session()->flash('message', 'Kullanıcı Başarıyla Güncellendi');
    }

    public function getUser2(User $user){
        $this->name = $user->name;
        $this->user_id = $user->id;
    }

    public function destroy(){
        
        $user = User::where('id',$this->user_id)->first();
        $user->delete();
        $this->emit('delete-user');

        session()->flash('message', 'Kullanıcı Silindi');
        
    }
}
