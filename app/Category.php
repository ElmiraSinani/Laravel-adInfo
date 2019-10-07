<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $fillable = ['slug', 'name', 'description', 'image'];

    public function questions(){
        return $this->belongsToMany(Question::class,'question_category');
    }
}
