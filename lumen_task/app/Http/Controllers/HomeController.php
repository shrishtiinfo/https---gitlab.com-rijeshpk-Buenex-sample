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
use Config;

class HomeController extends Controller
{
    public function products() {
        $url = Config::get('constants.api_url')."product";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);

			$data = array(
				'api_token' => Session::get('api_token'),
			);


			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			$contents = curl_exec($ch);
			curl_close($ch);	
						
			$data = json_decode($contents);
			if($data->response == "success") {
				$products = $data->products;
				return view('product.list', [
					'model' => $products
				]);
			}
    }
	
	public function addProduct() {
        return view('product.add');
    }
	
	public function store(Request $request) {
		$rules = array(
			'name'  => 'required',
			'price' => 'required|integer',
		);
		// validate against the inputs
		$validator = Validator::make($request->all(), $rules);
		// check if the validator failed
		if ($validator->fails()) 
		{
		  //invalid form
		  //redirect our user back with error messages       
          $messages = $validator->messages();
          return redirect()->route('add_product')->withErrors($validator)->withInput();
		}
		else
		{			
			$url = Config::get('constants.api_url')."product/create";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);

			$data = array(
				'api_token' => Session::get('api_token'),
				'title' 	   	=> $request->input('title'),
				'description' 	=> $request->input('description'),
				'price' 		=> $request->input('price')
			);


			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			$contents = curl_exec($ch);
			curl_close($ch);	
						
			$data = json_decode($contents);
			
			if($data->response == "success") {
				return redirect()->route('home');
			} else {
				return redirect()->route('add_product');
			}
			
		}
	}
	
	public function logout() {
		Session::flush();
		return redirect()->route('login');
	}
	
}
