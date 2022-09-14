<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoggingAPI extends Model
{
    use HasFactory;
    protected $table = 'logging_api';
    protected $fillable = [
        'uri', 'method', 'ip', 'response', 'request', 'user_id'
    ];
}
