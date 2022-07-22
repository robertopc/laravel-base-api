<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    const UPDATED_AT = NULL;

    protected $fillable = [
        'user_id',
        'ip',
        'action',
        'url',
        'description',
        'user_agent'
    ];
}