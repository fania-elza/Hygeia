<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'customer_id',
        'receiver_name',
        'phone_number',
        'full_address',
        'city',
        'postal_code',
        'notes',
    ];

    /**
     * Relasi ke model User (customer).
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
