<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];

    /**
     * @var None
     * 
     * @return User
     * */
    
     public function user() {

         return $this->belongsTo(User::class);
     }
}
