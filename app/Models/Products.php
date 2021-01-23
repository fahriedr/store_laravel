<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable =
    [
        'name',
        'brand_id',
        'category_id',
        'price',
        'stock',
        'description',
        'barcode'
    ];

    public function brands()
    {
        return $this->belongsTo(Brands::class, 'brand_id');
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function getPict()
    {
        if (!$this->product_pict) {
            return asset('backend/images/products_image/default.jpg');
        }

        return asset('backend/images/products_image/' . $this->product_pict);
    }

    public function product_images()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }
}
