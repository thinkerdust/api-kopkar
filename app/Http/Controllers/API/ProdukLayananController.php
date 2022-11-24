<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProdukLayanan;

class ProdukLayananController extends BaseController
{
    public function index()
    {
        $auth = Auth::user();
        $data = ProdukLayanan::where('nik', $auth->nik)->get();

        if($data->isNotEmpty()){
            return $this->sendResponse($data, 'Berhasil!');
        }else{
            return $this->sendError('Data Kosong!', 200);
        }
    }
}
