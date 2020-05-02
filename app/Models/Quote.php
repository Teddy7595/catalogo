<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    const UPDATED_AT = null;
    
    protected $table = 'catg_quotes'; 

    protected $casts = 
    [
        'created_at' => 'datetime:d-m-Y H:i'
    ];

    protected $fillable =
    [
        'bsdls',
        'bseur'
    ];

    protected $dateformat = 'd-m-Y H:i';
}
