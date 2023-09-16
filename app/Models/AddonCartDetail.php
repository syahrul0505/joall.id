<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddonCartDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'cart_id',
        'addon_id',
        'user_id',
    ];

    public function addon()
    {
        return $this->hasOne(Addon::class, 'id', 'addon_id');
    }
    public function cart()
    {
        return $this->hasOne(Cart::class, 'id', 'cart_id');
    }
}