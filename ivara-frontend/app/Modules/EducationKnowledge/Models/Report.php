<?php

namespace App\Modules\EducationKnowledge\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'education_knowledge_reports';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
