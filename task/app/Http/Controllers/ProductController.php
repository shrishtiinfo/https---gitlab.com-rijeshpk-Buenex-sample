<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Products;

class ProductController extends Controller
{
    public function index(Request $request)
    {
		$user = User::where("api_token", "=", $request->input('api_token'))->first();
		
		if($user) {
			$products = Products::all();
			return response()->json($products);     
		} else {
			return response()->json("Unauthorized Access");
		}
    }
	
    public function getProduct($id){
		$user = User::where("api_token", "=", $request->input('api_token'))->first();
		
		if($user) {
			$product  = Products::find($id);  
			return response()->json($product);     
		} else {
			return response()->json("Unauthorized Access");
		}
    }
	
    public function createProduct(Request $request) {
		$user = User::where("api_token", "=", $request->input('api_token'))->first();
		
		if($user) {
			$product=Products::create($request->all());
			return response()->json($product);     
		} else {
			return response()->json("Unauthorized Access");
		}
    }
	
    public function updateProduct(Request $request, $id) {
		$user = User::where("api_token", "=", $request->input('api_token'))->first();
		
		if($user) {
			$product=Products::find($id);
			$product->name = $request->input('name');
			$product->description = $request->input('description');
			$product->price = $request->input('price');
			$product->save();
			return response()->json($product);      
		} else {
			return response()->json("Unauthorized Access");
		}  
    }
	
    public function deleteProduct($id) {
		$user = User::where("api_token", "=", $request->input('api_token'))->first();
		
		if($user) {
			$product  = Products::find($id);
			$product->delete();
        return response()->json('deleted');     
		} else {
			return response()->json("Unauthorized Access");
		}
    }
   
}
?>