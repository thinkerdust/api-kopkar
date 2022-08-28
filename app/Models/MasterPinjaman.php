<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterPinjaman extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'ms_pinjaman';
    protected $dates = ['deleted_at'];

    protected $hidden = [
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at'
    ];

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'kode', 'kode_pjmn');
    }
}
