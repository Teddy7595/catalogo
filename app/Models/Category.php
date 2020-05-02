<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const UPDATED_AT = null;
    
    protected $table = 'catg_category';

    protected $casts = 
    [
        'created_at' => 'datetime:d-m-Y H:i'
    ];

    protected $fillable =
    [
        'name',
        'department'
    ];

    protected $dateformat = 'd-m-Y H:i';


}
