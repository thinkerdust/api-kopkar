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
                    ->select('ms_pinjaman.*')
                    ->orderBy('ms_pinjaman.id')
                    ->get();
        return $this->sendResponse($data, 'Success!');
    }

    public function detail_pinjaman(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|exists:ms_pinjaman,kode',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $auth = Auth::user(); 
        $data = Pinjaman::with('ms_pinjaman')->where([['kode_pjmn',$request->kode], ['nik', $auth->nik]])->get();
        return $this->sendResponse($data, 'Berhasil!');
    }
}
