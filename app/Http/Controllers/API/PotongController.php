<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Anggota;
use App\Models\Potong;
use Validator;

class PotongController extends BaseController
{
    public function potong()
    {
        $auth = Auth::user(); 
        $data = Anggota::with('potong')->where('nik', $auth->nik)->get();
        return $this->sendResponse($data, 'Success!');
    }
}
