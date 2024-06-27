<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Tags extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    protected $table = 'tags';

    protected $fillable = [
        'name',
        'description'
    ];

    public function services()
    {
        return $this->belongsToMany(Services::class, 'service_tag');
    }

    public function products()
    {
        return $this->belongsToMany(Products::class, 'product_tag');
    }
}
