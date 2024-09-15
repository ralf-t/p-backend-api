<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Record extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'records';

    // date automatic
    protected $fillable = [
        'name',
        'location',
        'depth',
        'duration'
    ];
    
    protected $casts = [
        'name' => 'string',
        'location' => 'string',
        'depth' => 'integer',
        'duration' => 'integer'
    ];
}
