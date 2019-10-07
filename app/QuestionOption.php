<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model {
    
    protected $fillable = ['option', 'correct', 'question_id', 'image'];
    

    public function question(){
        return $this->belongsTo(Question::class, 'question_id');
    }
    
}
