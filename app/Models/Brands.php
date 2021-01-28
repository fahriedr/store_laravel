<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';
    protected $fillable = ['name', 'code', 'logo'];

    public function products()
    {
        return $this->hasMany(Products::class);
    }

    public function getLogo()
    {
        if (!$this->logo) {
            return asset('/backend/images/products-logo/default-logo.jpg');
        }
        return asset('assets/img/brands_logo/' . $this->logo);
    }
}
