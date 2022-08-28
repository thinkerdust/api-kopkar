<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Potong extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'potong';
    protected $dates = ['deleted_at'];
}
