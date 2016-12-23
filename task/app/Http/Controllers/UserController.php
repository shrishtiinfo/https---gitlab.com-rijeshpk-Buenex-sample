<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    private $salt;
	
    public function __construct()
    {
        $this->salt = "lumen_task";
    }
	
    public function login(Request $request){
      if ($request->has('username') && $request->has('password')) {
        $user = User::where("username", "=", $request->input('username'))
                      ->where("password", "=", sha1($this->salt.$request->input('password')))
                      ->first();
        if ($user) {
          $token = str_random(60);
          $user->api_token = $token;
          $user->save();
          return response()->json($user->api_token);
        } else {
          return response()->json("Login unsuccessful");
        }
      } else {
        return response()->json("Username and Password are mandatory fields");
      }
    }
	
    public function register(Request $request){
      if ($request->has('username') && $request->has('password') && $request->has('name')) {
        $user = new User;
        $user->username = $request->input('username');
        $user->password = sha1($this->salt.$request->input('password'));
        $user->name = $request->input('name');
        $user->api_token = str_random(60);
        if($user->save()){
          return response()->json("User registered successfully");
        } else {
          return response()->json("User registration unsuccessful");
        }
      } else {
		return response()->json("Please fill all fields");
      }
    }
}