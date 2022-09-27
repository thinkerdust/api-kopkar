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
    public function index()
    {
        $auth = Auth::user();
        $data = Tabungan::where('nik', $auth->nik)->get();

        if($data->isNotEmpty()){
            return $this->sendResponse($data, 'Berhasil!');
        }else{
            return $this->sendError('Data Kosong!', 200);
        }
    }
 
    public function jenis_tabungan()
    {
        $auth = Auth::user();
        $data = MasterTabungan::join('tabungan', 'ms_tabungan.jenis', '=', DB::raw('left(tabungan.no_acc, 1)'))
                    ->where('tabungan.nik', $auth->nik)
                    ->select('ms_tabungan.id', 'ms_tabungan.jenis', 'ms_tabungan.nama')
                    ->orderBy('ms_tabungan.id')
                    ->get();

        if($data->isNotEmpty()){
            return $this->sendResponse($data, 'Berhasil!');
        }else{
            return $this->sendError('Data Kosong!', 200);
        }
    }

    public function detail_tabungan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_acc' => 'required|exists:tabungan,no_acc',
        ],[
            'required'  => 'field :attribute harus di isi.',
            'exists'    => ':attribute tidak ditemukan.',
        ]);
   
        if($validator->stopOnFirstFailure()->fails()){
            return $this->sendError($validator->errors()->first(), 200);       
        }

        $auth = Auth::user();
        $data = TabunganDetail::where('no_acc', $request->no_acc)->get();
        
        if($data->isNotEmpty()){
            return $this->sendResponse($data, 'Berhasil!');
        }else{
            return $this->sendError('Data Kosong!', 200);
        }
    }
}
