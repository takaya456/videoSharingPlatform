<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'url', 
        'explanation',
        'user_id',
    ];
    
    // public function get(){
    //     return $this->orderBy('updated_at', 'DESC');
    // }
}
