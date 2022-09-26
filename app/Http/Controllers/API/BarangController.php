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

        if($data->isNotEmpty()){
            return $this->sendResponse($data, 'Berhasil!');
        }else{
            return $this->sendError('Data Kosong!', 200);
        }
    }

    public function barang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|exists:kategori,kode',
        ],[
            'required'  => 'field :attribute harus di isi.',
            'exists'    => ':attribute tidak ditemukan.',
        ]);
   
        if($validator->stopOnFirstFailure()->fails()){
            return $this->sendError($validator->errors()->first(), 200);       
        }

        $data = Barang::with('kategori')->where('kode_ktgori',$request->kode)->get();
        
        if($data->isNotEmpty()){
            return $this->sendResponse($data, 'Berhasil!');
        }else{
            return $this->sendError('Data Kosong!', 200);
        }
    }
}
