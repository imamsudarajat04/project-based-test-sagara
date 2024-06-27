<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Products extends Model
{
    use HasFactory, Uuids;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'quantity',
        'purchasing_price',
        'selling_price',
        'description',
        'tag_id'
    ];

    public function tags()
    {
        return $this->hasMany(Tags::class, 'tag_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'product_id', 'id');
    }
}
