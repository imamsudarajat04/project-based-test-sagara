<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'status',
        'error_log',
        'rows_success',
        'rows_failed',
        'failed_file_path'
    ];
}
