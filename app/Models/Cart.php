<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';


    protected $fillable=[

        'user_id',
        'name',
        'price',
        'quantity',
        'image',
    ];
}
