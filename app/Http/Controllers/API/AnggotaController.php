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

    public function transaksi_simpanan_sukarela()
    {
        $auth = Auth::user(); 
        $data = TrxSimpSukarela::where('nik', $auth->nik)->get();

        if($data->isNotEmpty()){
            return $this->sendResponse($data, 'Berhasil!');
        }else{
            return $this->sendError('Data Kosong!', 200);
        }
    }
}
