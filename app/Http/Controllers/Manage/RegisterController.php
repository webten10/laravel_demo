<?php

namespace App\Http\Controllers\manage;

use App\register;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use session;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function index(){
    // 	return view('manage\login');
    // 	// echo 'fsdfsdf';
    // 	// exit;	
    // }
    
    public function check(Request $request)
    {
        $return = array();
        $input = $request->all();


        echo '<pre>';
        print_r($input);
        exit;
        
        $model = new User;
        //print_r($input); exit();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
     
        if ($validator->fails()) {
            _error(400, $validator->errors());
        } else {
            
            if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])){
                $user_data = General::get_where('users', array('email'=>$input['email']));
                $request->session()->put('users', $user_data);
                $url='';
                if(isset($input['gateway_type']) && $input['gateway_type'] == 'stripe'){
                    $authorize_request_body = array(
                        'response_type' => 'code',
                        'scope' => 'read_write',
                        'client_id' => 'ca_AK0YampxMCKpmRj82EiS5JGiIwXlCgEU'
                    );
                    $url= "https://connect.stripe.com/oauth/authorize?".http_build_query($authorize_request_body);
                }
                $return['status'] = true;
                $return['message'] = 'Login Successfully';
                $return['data'] = array('url'=>$url,'gateway'=>1);
                //return $this->handleUserWasAuthenticated($request, $throttles);
                //return view('main');
                //view('main');
                }
             else {
                $return['status'] = false;
                $return['message'] = 'Invalid email or password';
            }
            return json_encode($return);
        }
    }
    
}
