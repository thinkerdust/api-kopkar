<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransaksiToko;
use Validator;
use DB;

class TokoController extends BaseController
{
    public function transaksi(Request $request) 
    {
        $start = $request->start;
        $count = $request->count;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $auth = Auth::user(); 
        $data = TransaksiToko::where('nik', $auth->nik)
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
