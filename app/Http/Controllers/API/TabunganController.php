<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterTabungan;
use App\Models\Tabungan;
use DB;

class TabunganController extends BaseController
{
    public function jenis_tabungan()
    {
        $auth = Auth::user();
        $data = MasterTabungan::join('tabungan', 'ms_tabungan.jenis', '=', DB::raw('left(tabungan.no_acc, 1)'))
                    ->where('tabungan.nik', $auth->nik)
                    ->select('ms_tabungan.id', 'ms_tabungan.jenis', 'ms_tabungan.nama')
                    ->orderBy('ms_tabungan.id')
                    ->get();
        return $this->sendResponse($data, 'Berhasil!');
    }

    public function detail_tabungan(Request $request)
    {
        $auth = Auth::user();
        $data = Tabungan::with('tabungan_detail')->where('tabungan.nik', $auth->nik);

        $jenis = $request->jenis;
        if($jenis) {
            $data->whereRaw('left(tabungan.no_acc, 1) = ?', [$jenis]);
        }
        
        return $this->sendResponse($data->get(), 'Berhasil!');
    }
}
