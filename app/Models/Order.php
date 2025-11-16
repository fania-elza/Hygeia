<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        // Relasi user
        'user_id',

        // Harga & pembayaran
        'total_amount',
        'payment_method',
        'status',

        // Informasi pengiriman
        'receiver_name',
        'phone_number',
        'full_address',
        'city',
        'postal_code',
        'notes',

        // rincian harga
        'subtotal',
        'shipping_cost',
        'discount'
    ];

    /**
     * Relasi ke customer (User)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Order Items (1 order punya banyak item)
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
