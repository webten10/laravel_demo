<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Admin;

class SigninController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('auth');
  //     $this->middleware('guest')->except('logout');
    }
    public function index()
    {
        return view('manage/home');
    }

    public function insert(){
        $user = new Admin;
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = '123456';
        $user->save();
    }


}
