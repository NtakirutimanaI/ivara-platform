<?php

namespace App\Modules\EducationKnowledge\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'education_knowledge_materials';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
