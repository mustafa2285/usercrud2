<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Auth;

class UserLogin extends Component
{
    public $email;
    public $password;

    public $rules = [
        'email' => 'required',
        'password' => 'required',
    ];

    public $messages = [
        'email.required' => 'Email alanı gereklidir',
        'password.required' => 'Şire alanı gereklidir',
    ];

    public function render()
    {
        return view('livewire.auth.user-login');
    }

    public function userLogin(){
        $this->validate();

        if (Auth::attempt(['email'=>$this->email, 'password'=>$this->password])){
            // session()->flash('message', 'Giriş başarılı');
           $message =  'Kullanıcı Girişi Başarılı.';
           $alert = 'success';
            //return redirect()->route('dashboard.index');
            $status = true;

        }
        else{
            // session()->flash('message', 'Giriş başarısız');
           $message =  'Kullanıcı Girişi Başarısız.';
           $alert = 'error';
           $status = false;
        }

        $this->reset();
        $this->dispatchBrowserEvent('user-login',[
            "closeButton"=> false,
            "debug"=> false,
            "newestOnTop"=> false,
            "progressBar"=> false,
            "positionClass"=> "toast-top-right",
            "preventDuplicates"=> false,
            "onclick"=> null,
            "showDuration"=> "300",
            "hideDuration"=> "1000",
            "timeOut"=> "5000",
            "extendedTimeOut"=> "1000",
            "showEasing"=> "swing",
            "hideEasing"=> "linear",
            "showMethod"=> "fadeIn",
            "hideMethod"=> "fadeOut",
            'message'=>  $message,
            'alert'=>  $alert,
            'status'=> $status,
        ]);
    }
}
