<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tabungan extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'tabungan';
    protected $dates = ['deleted_at'];

    protected $hidden = [
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at'
    ];

    public function tabungan_detail()
    {
        return $this->hasMany(TabunganDetail::class, 'no_acc', 'no_acc');
    }
}
