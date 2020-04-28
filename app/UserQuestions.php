<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserQuestions extends Model
{
    protected $fillable = ['question_id', 'user_id', 'answer_id'];
}
