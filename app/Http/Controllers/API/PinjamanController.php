<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterPinjaman;
use App\Models\Pinjaman;
use Validator;
use DB;

class PinjamanController extends BaseController
{
    public function jenis_pinjaman()
    {
        $auth = Auth::user(); 
        $data = MasterPinjaman::join('pinjaman', 'ms_pinjaman.kode', '=', 'pinjaman.kode_pjmn')
                    ->where('pinjaman.nik', $auth->nik)
                    ->select('ms_pinjaman.kode', 'ms_pinjaman.nama', 'ms_pinjaman.batas', 'ms_pinjaman.jumlah', 'ms_pinjaman.bunga')
                    ->groupBy('ms_pinjaman.kode', 'ms_pinjaman.nama', 'ms_pinjaman.batas', 'ms_pinjaman.jumlah', 'ms_pinjaman.bunga')
                    ->orderBy('ms_pinjaman.kode')
                    ->get();
        
        if($data->isNotEmpty()){
            return $this->sendResponse($data, 'Berhasil!');
        }else{
            return $this->sendError('Data Kosong!', 200);
        }
    }

    public function detail_pinjaman(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|exists:ms_pinjaman,kode',
        ],[
            'required'  => 'field :attribute harus di isi.',
            'exists'    => 'field :attribute tidak ditemukan.',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->errors(), 200);       
        }

        $auth = Auth::user(); 
        $data = Pinjaman::with('ms_pinjaman')->where([['kode_pjmn',$request->kode], ['nik', $auth->nik]])->get();
        
        if($data->isNotEmpty()){
            return $this->sendResponse($data, 'Berhasil!');
        }else{
            return $this->sendError('Data Kosong!', 200);
        }
    }
}
