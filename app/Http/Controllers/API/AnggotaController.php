<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\TrxSimpSukarela;
use Validator;

class AnggotaController extends BaseController
{
    public function index()
    {   
        $auth = Auth::user(); 
        $data = Anggota::where('nik', $auth->nik)->first();
        
        if($data){
            return $this->sendResponse($data, 'Berhasil!');
        }else{
            return $this->sendError('Data Kosong!', 200);
        }
    }   

    public function transaksi_simpanan_sukarela(Request $request)
    {
        $start = $request->start;
        $count = $request->count;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $auth = Auth::user(); 
        $data = TrxSimpSukarela::where('nik', $auth->nik)
                    ->whereBetween('tanggal', [$start_date, $end_date])
                    ->orderBy('tanggal', 'desc')
                    ->skip($start)->take($count)
                    ->get();

        if($data->isNotEmpty()){
            return $this->sendResponse($data, 'Berhasil!');
        }else{
            return $this->sendError('Data Kosong!', 200);
        }
    }
}
