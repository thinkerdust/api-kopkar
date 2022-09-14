<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxSimpSukarela extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'trx_simpanan_sukarela';
    protected $dates = ['deleted_at'];
}
