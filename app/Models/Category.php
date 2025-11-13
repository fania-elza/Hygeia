<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'total_product',
        'status',
    ];

    protected $casts = [
        'total_product' => 'integer',
    ];

    // Event untuk generate Category ID secara otomatis saat creating
    protected static function booted()
    {
        static::creating(function ($category) {
            $category->category_id = self::generateCategoryId($category->name);
        });
    }

    /**
     * Generate Category ID: 3 huruf konsonan pertama dari name + angka unik.
     */
    private static function generateCategoryId(string $name): string
    {
        // Ambil konsonan dari name (huruf besar, abaikan vokal dan spasi)
        $consonants = preg_replace('/[^BCDFGHJKLMNPQRSTVWXYZ]/i', '', strtoupper($name));
        
        // Ambil 3 konsonan pertama, atau isi dengan 'CAT' jika kurang dari 3
        $code = substr($consonants, 0, 3);
        if (strlen($code) < 3) {
            $code = str_pad($code, 3, 'CAT', STR_PAD_RIGHT); // Fallback jika konsonan kurang
        }

        // Cari ID unik dengan menambah angka (misal: ELK001, ELK002, dll.)
        $counter = 1;
        $uniqueId = $code . str_pad($counter, 3, '0', STR_PAD_LEFT);
        while (self::where('category_id', $uniqueId)->exists()) {
            $counter++;
            $uniqueId = $code . str_pad($counter, 3, '0', STR_PAD_LEFT);
        }

        return $uniqueId;
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

    // Relasi dengan Product (jika ada model Product)
    public function products()
    {
         return $this->hasMany(Product::class);
    }
}