<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model{

    protected $fillable = ['question', 'category', 'description', 'image'];

    public function options() {
        return $this->hasMany(QuestionOption::class, 'question_id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'question_category');
    }
}
