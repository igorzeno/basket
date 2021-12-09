<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = false;

    public function cartBy(User $user){
        return $this->carts->contains('user_id', $user->id);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}

