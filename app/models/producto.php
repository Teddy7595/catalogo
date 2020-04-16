<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    protected $table = 'productos';

    protected $fillable = ['cod', 'name', 'descp', 'photo', 
    'precio_dls', 'precio_eur', 'iva', 'cantidad', 'create_at'];

    protected $hidden = [];

    public $timestamps = false;
}
