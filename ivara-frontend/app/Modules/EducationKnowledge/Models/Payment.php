<?php

namespace App\Modules\EducationKnowledge\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'education_knowledge_payments';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
