<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function orders() {
        return $this->hasMany(Order::class);
    }

    // Jika ingin 5 transaksi terakhir
    public function recent_orders() {
        return $this->hasMany(Order::class)->latest()->limit(5);
    }
}
