<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Kategori;
use Validator;
use DB;

class BarangController extends BaseController
{
    public function kategori()
    {
        $data = Kategori::get();
        return $this->sendResponse($data, 'Berhasil!');
    }

    public function barang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|exists:kategori,kode',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $data = Barang::with('kategori')->where('kode_ktgori',$request->kode)->get();
        return $this->sendResponse($data, 'Berhasil!');
    }
}
