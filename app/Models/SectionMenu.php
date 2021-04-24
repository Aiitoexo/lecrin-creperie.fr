<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionMenu extends Model
{
    use HasFactory;

    public function allMenuItemBySection()
    {
        return $this->hasMany(MenuItem::class, 'section');
    }
}
