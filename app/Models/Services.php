<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Services extends Model
{
    use HasFactory, Uuids;

    protected $table = 'services';

    protected $fillable = [
        'name',
        'base_price',
        'selling_price'
    ];

    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'service_id', 'id');
    }
}
