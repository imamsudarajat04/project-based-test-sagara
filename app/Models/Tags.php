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

    public function products()
    {
        return $this->belongsTo(Products::class, 'tag_id', 'id');
    }
}
