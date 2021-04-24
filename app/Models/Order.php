<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public const PENDING = 'pending';
    public const IN_PROGRESS = 'in_progress';
    public const DELIVERED = 'delivered';
    public const FINISHED = 'finished';
    public const CANCELED = 'canceled';

    protected $fillable = [
        'reference',
        'id_transaction',
        'status',
        'last_name',
        'first_name',
        'phone',
        'mail',
        'adresse',
        'city',
        'postal',
        'text',
        'type_command',
        'command',
        'price',
        'is_prepared',
        'is_delivered',
    ];

    protected $casts = [
      'command' => 'array'
    ];

}
