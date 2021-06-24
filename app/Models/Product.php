<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Freshbitsweb\LaravelCartManager\Traits\Cartable;

class Product extends Model
{
    use HasFactory, Cartable;

    protected $guarded = ['id'];

    public function scopeByCategory($query, $category)
    {
        return $query->where('type', $category);
    }

    public function scopeByName($query, $name)
    {
        return $query->where('name', $name);
    }
}
