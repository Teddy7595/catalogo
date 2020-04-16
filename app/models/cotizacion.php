<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class cotizacion extends Model
{
    protected $table = 'cotizaciones';

    public $timestamps = false;

    protected $fillable = ['precio_BS_DLS', 'precio_BS_EUR', 'create_at'];
}
