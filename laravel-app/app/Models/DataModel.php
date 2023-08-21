<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataModel extends Model
{
    use HasFactory;

    protected $table = 'datas';
    protected $fillable = [
        'name',
        'google_id',
        'created_at',
        'updated_at',
        'status',
    ];
    
    
}
