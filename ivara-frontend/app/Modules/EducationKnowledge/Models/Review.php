<?php

namespace App\Modules\EducationKnowledge\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'education_knowledge_reviews';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
