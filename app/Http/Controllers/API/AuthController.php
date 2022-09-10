<?php
   
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Carbon\Carbon;
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

    public function change_password(Request $request)
    {
        if(Hash::check($request->old_password, auth()->user()->password)){ 
            $validator = Validator::make($request->all(), 
                [
                    'password'          => 'required|min:4|max:255',
                    'confirm_password'  => 'required|same:password',
                ],
                [
                    'required'  => 'field :attribute harus di isi.',
                    'min'       => 'field :attribute minimal 4 karakter',
                    'same'      => 'field :attribute tidak sama dengan password'
                ]
            );

            if($validator->fails()){
                return $this->sendError($validator->errors());       
            }

            $time = Carbon::now();
            $success = User::find(auth()->user()->id)->update(['password'=> bcrypt($request->password), 'updated_at' => $time]);

            return $this->sendResponse($success, 'Berhasil!');
        } 
        else{ 
            return $this->sendError('Password lama anda salah.');
        } 
    }

    public function check_validation_password()
    {
        $auth = Auth::user();
        return $this->sendResponse($auth, 'Berhasil!');
    }
   
}