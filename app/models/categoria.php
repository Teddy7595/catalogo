<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    protected $table = 'categorias';

    public $timestamps = false;

    protected $fillable = ['name', 'create_at'];
}
