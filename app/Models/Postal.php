<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postal extends Model
{
    protected $fillable = [
        'postal_code'
    ];

    use HasFactory;
}
