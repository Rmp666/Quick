<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'discr', 'text', 'updated_at'
    ];
    
    // Находит user_id в таблице users
    public function user ()
    {
        return $this->belongsTo('App\User');
    } 
}
