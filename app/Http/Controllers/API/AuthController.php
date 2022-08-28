<?php
   
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Validator;
   
class AuthController extends BaseController
{

    public function login(Request $request)
    {
        if(Auth::attempt(['nik' => $request->nik, 'password' => $request->password])){ 
            $auth = Auth::user(); 
            $success['token'] =  $auth->createToken('AuthToken')->plainTextToken; 
            $success['nik'] =  $auth->nik;
   
            return $this->sendResponse($success, 'User logged-in!');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|exists:anggota,nik',
            'username' => 'required|max:255',
            'email' => 'nullable|email|max:255',
            'password' => 'required|min:4|max:255',
            'confirm_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success = $user;
   
        return $this->sendResponse($success, 'User successfully registered!');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->sendResponse([], 'User logged-out!');
    }
   
}