<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    protected $appends = [
        'formatted_price',
        'formatted_stock',
        'image_url',
        'short_description'
    ];

    public function getFormattedPriceAttribute()
    {
        return 'Rp. ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedStockAttribute()
    {
        return number_format($this->stock, 0, ',', '.');
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/images/' . $this->image);
    }

    public function getShortDescriptionAttribute()
    {
        return Str::limit($this->description, 100, '...');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
