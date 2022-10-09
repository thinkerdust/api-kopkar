<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiTokoDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'transaksi_toko_detail';
    protected $dates = ['deleted_at'];

    protected $hidden = [
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at'
    ];
}
