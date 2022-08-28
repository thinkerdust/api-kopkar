<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends BaseController
{
    public function kategori()
    {
        $data = Kategori::get();
        return $this->sendResponse($data, 'Success!');
    }

    public function barang()
    {
        $data = Barang::with('kategori')->get();
        return $this->sendResponse($data, 'Success!');
    }
}
