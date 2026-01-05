<?php

namespace App\Modules\EducationKnowledge\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'education_knowledge_settings';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
