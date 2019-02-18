<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'id', 'name', 'code'
    ];
    
    public $timestamps = false;
    
    public function user ()
    {
        return $this->hasOne('App\User');
    }
}

