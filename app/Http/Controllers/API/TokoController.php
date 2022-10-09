<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransaksiToko;
use App\Models\TransaksiTokoDetail;
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

    public function detail_transaksi(Request $request)
    {
        $nota = $request->nota;
        $auth = Auth::user(); 

        $data = DB::table('transaksi_toko_detail as ttd')
                    ->where([ ['ttd.nik', $auth->nik], ['ttd.nota', $nota] ])
                    ->leftJoin('barang as b', 'ttd.kode_brg', '=', 'b.kode')
                    ->select('ttd.*', 'b.nama as barang')
                    ->get();

        if($data->isNotEmpty()){
            return $this->sendResponse($data, 'Berhasil!');
        }else{
            return $this->sendError('Data Kosong!', 200);
        }
    }
}
