<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
   protected $table = 'catg_clients'; 

   protected $fillable =
   [
      'user_id',
      'adress1',
      'adress2',
      'phone1',
      'phone2'
   ];

   protected $dateformat = 'd-m-Y H:i';

   protected $casts = 
    [
        'created_at' => 'datetime:d-m-Y H:i',
        'updated_at' => 'datetime:d-m-Y H:i'
    ];

   protected $attributes = [];

   public function user()
   {
      return $this->belongsTo('App\Models\User');
   }
}
