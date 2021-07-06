<?php
namespace App\Http\Controllers;
use App\Http\Resources\LoginRessource;
use App\ApiCode;
use App\User;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request) {
        $credentials = request()->validate([ 
            'username' => 'required|string', 
            'password' => 'required|string|max:25'
        ]);

        if (! $token = auth()->attempt($credentials)) {
            return $this->respondUnAuthorizedRequest(ApiCode::INVALID_CREDENTIALS);
        }

        if (empty(auth()->user()->email_verified_at))
        {
             return response()->json(['error' => 'Your have not verified your email.'], 401);
        }

        return $this->respondWithToken($request,$token);
    }

     

    private function respondWithToken($request,$token) {
        $connectedUser=$request->user();
        $data= array(
            'workspace' => $connectedUser->workspace,
            'username' =>$request->username, 
            'password' =>"",  
            'role'=>$connectedUser->role, 
            'site_map'=>$connectedUser->site_map, 
            'access_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 600,
            'token' =>$token
        );
        return $data; 
        // return $this->respond([
        //     'token' => $token,
        //     'access_type' => 'bearer',
        //     'expires_in' => auth()->factory()->getTTL() * 60
        // ], "Login Successful");
    }


    public function logout() {
        auth()->logout();
        return $this->respondWithMessage('User successfully logged out');
    }


    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }

    public function me() { 
        $user=auth()->user();
        return $this->respond($user);
    }
}
