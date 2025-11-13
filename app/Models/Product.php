<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'category_id',
        'price',
        'stock',
        'description',
        'image',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    // Event untuk generate Product ID secara otomatis saat creating
    protected static function booted()
    {
        static::creating(function ($product) {
            $product->product_id = self::generateProductId($product->name);
        });
    }

    /**
     * Generate Product ID: 3 huruf konsonan dari name + angka unik jika duplikasi.
     */
    private static function generateProductId(string $name): string
    {
        // Ambil konsonan dari name (huruf besar, abaikan vokal dan spasi)
        $consonants = preg_replace('/[^BCDFGHJKLMNPQRSTVWXYZ]/i', '', strtoupper($name));
        
        // Ambil 3 konsonan pertama, atau isi dengan 'PRD' jika kurang dari 3
        $code = substr($consonants, 0, 3);
        if (strlen($code) < 3) {
            $code = str_pad($code, 3, 'PRD', STR_PAD_RIGHT); // Fallback jika konsonan kurang
        }

        // Jika code sudah unik, gunakan langsung; jika tidak, tambah angka
        if (!self::where('product_id', $code)->exists()) {
            return $code;
        }

        // Cari ID unik dengan menambah angka (misal: PRC001, PRC002, dll.)
        $counter = 1;
        $uniqueId = $code . str_pad($counter, 3, '0', STR_PAD_LEFT);
        while (self::where('product_id', $uniqueId)->exists()) {
            $counter++;
            $uniqueId = $code . str_pad($counter, 3, '0', STR_PAD_LEFT);
        }

        return $uniqueId;
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accessor untuk image URL
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    // Scope untuk filter status
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    // Scope untuk low stock (misal: stock < 10)
    public function scopeLowStock($query, $threshold = 10)
    {
        return $query->where('stock', '<', $threshold);
    }
}