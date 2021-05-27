<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveTypeCommand extends Model
{
    protected $fillable = [
        'active_command_livraison',
        'active_command_emporter',
    ];

    protected $casts = [
        'active_command_livraison' => 'boolean',
        'active_command_emporter' => 'boolean',
    ];

    use HasFactory;
}
