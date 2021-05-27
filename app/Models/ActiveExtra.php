<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveExtra extends Model
{
    protected $fillable = [
        'active_extras'
    ];

    protected $casts = [
        'active_extras' => 'boolean',
    ];

    use HasFactory;
}
