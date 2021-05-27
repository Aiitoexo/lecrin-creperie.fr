<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDrink extends Model
{
    protected $fillable = [
        'category'
    ];

    use HasFactory;
}
