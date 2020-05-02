<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    const UPDATED_AT = null;
    
    protected $table = 'catg_banks';

    protected $casts = 
    [
        'created_at' => 'datetime:d-m-Y H:i',
        'updated_at' => 'datetime:d-m-Y H:i'
    ];

    protected $dateformat = 'd-m-Y H:i';

    protected $fillable = 
    [
        'name', 
        'email', 
        'password',
        'ci',
        'cod',
        'phone',
        'type',
        'titular',
        'prefix'
    ];
}
