<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Page extends Model
{
use HasFactory;


protected $fillable = ['menu_id','title','content','created_by'];


public function menu() { return $this->belongsTo(Menu::class); }
public function author() { return $this->belongsTo(User::class, 'created_by'); }
}