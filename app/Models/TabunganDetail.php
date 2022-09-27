<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TabunganDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'tabungan_detail';
    protected $dates = ['deleted_at'];
    
}
