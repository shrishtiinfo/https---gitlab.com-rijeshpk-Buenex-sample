<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Client;
use Session;

class UserController extends Controller
{
    public function login() {
        return view('user.login');
    }
	
	public function signin(Request $request) {
        $rules = array(
			'username'         		=> 'required',
			'password'         		=> 'required'
		);
		// validate against the inputs
		$validator = Validator::make($request->all(), $rules);
		// check if the validator failed
		if ($validator->fails()) 
		{
		  //invalid form
		  //redirect our user back with error messages       
          $messages = $validator->messages();
          return redirect()->route('login')->withErrors($validator)->withInput();
		}
		else
		{	
			$url = Config::get('constants.api_url')."users/login";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);

			$data = array(
				'username' => $request->input('username'),
				'password' => $request->input('password')
			);


			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			$contents = curl_exec($ch);
			curl_close($ch);	
						
			$data = json_decode($contents);
			//echo $data->api_token; exit;
			if($data->response == "Login successful") {
				Session::put('api_token', $data->api_token);
				return redirect()->route('home');
			} else {
				return redirect()->route('login');
			}
		}
    }
	
	public function register() {
        return view('user.register');
    }
	
	public function store(Request $request) {
		$rules = array(
			'name'             		=> 'required',
			'username'         		=> 'required',
			'password'         		=> 'required:confirmed',
			'password_confirmation' => 'required',
		);
		// validate against the inputs
		$validator = Validator::make($request->all(), $rules);
		// check if the validator failed
		if ($validator->fails()) 
		{
		  //invalid form
		  //redirect our user back with error messages       
          $messages = $validator->messages();
          return redirect()->route('register')->withErrors($validator)->withInput();
		}
		else
		{			
			$url = Config::get('constants.api_url')."users/register";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);

			$data = array(
				'name' 	   => $request->input('name'),
				'username' => $request->input('username'),
				'password' => $request->input('password')
			);


			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			$contents = curl_exec($ch);
			curl_close($ch);	
						
			$data = json_decode($contents);
			
			if($data->response == "User registered successfully") {
				return redirect()->route('login');
			} else {
				return redirect()->route('register');
			}
			
		}
	}
	
}
