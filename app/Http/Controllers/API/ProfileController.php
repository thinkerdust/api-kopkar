<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Anggota;
use Validator;

class ProfileController extends BaseController
{
    public function my_profile()
    {   
        $auth = Auth::user(); 
        $data = Anggota::where('nik', $auth->nik)->first();
        return $this->sendResponse($data, 'Berhasil!');
    }   
}
