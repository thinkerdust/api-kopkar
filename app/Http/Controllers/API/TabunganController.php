<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\MasterTabungan;

class TabunganController extends BaseController
{
    public function jenis_tabungan()
    {
        $data = MasterTabungan::get();
        return $this->sendResponse($data, 'Success!');
    }
}
