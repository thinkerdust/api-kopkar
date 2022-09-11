<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterTabungan;
use App\Models\Tabungan;
use App\Models\TabunganDetail;
use Validator;
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
        $validator = Validator::make($request->all(), [
            'jenis' => 'required|exists:ms_tabungan,jenis',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $auth = Auth::user();
        $data = [];
        $jenis = $request->jenis;
        $tabungan = Tabungan::where('tabungan.nik', $auth->nik)
                ->whereRaw('left(tabungan.no_acc, 1) = ?', [$jenis])
                ->first();

        $tabungan_detail = TabunganDetail::where('no_acc', $tabungan->no_acc)->get();
        
        $data = $tabungan;
        $data['tabungan_detail'] = $tabungan_detail;
        
        return $this->sendResponse($data, 'Berhasil!');
    }
}
