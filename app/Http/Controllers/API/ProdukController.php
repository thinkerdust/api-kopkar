<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends BaseController
{
    public function index()
    {
        $data = Produk::get();
        return $this->sendResponse($data, 'Berhasil!');
    }
}
