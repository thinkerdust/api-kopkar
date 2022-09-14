<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Anggota;
use App\Models\Potong;
use Validator;
use DB;

class PotongController extends BaseController
{
    public function potong()
    {
        $auth = Auth::user(); 
        $potong = Potong::where('nik', $auth->nik)->select('*', DB::raw("(potong+biaya+jasa) as total"))->get();
        // $total = Potong::where('nik', $auth->nik)->select(DB::raw("SUM(potong) as potong"), DB::raw("SUM(biaya) as biaya"), DB::raw("SUM(jasa) as jasa"))->first();

        $data = $potong;
        // $data['total'] = $total;
        
        if($data->isNotEmpty()){
            return $this->sendResponse($data, 'Berhasil!');
        }else{
            return $this->sendError('Data Kosong!');
        }
    }
}
