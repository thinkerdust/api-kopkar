<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pinjaman extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'pinjaman';
    protected $dates = ['deleted_at'];

    protected $hidden = [
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at'
    ];

    public function ms_pinjaman()
    {
        return $this->belongsTo(MasterPinjaman::class, 'kode_pjmn', 'kode');
    }
}
