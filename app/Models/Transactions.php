<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Transactions extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    protected $table = 'transactions';

    protected $fillable = [
        'product_id',
        'service_id',
        'user_id',
        'customer_name',
        'quantity',
        'total',
        'status'
    ];

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function services()
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
