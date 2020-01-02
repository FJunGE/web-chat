<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfflineMessage extends Model
{
    protected $fillable = [
        'user_id', 'message', 'status'
    ];
}
