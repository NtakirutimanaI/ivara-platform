<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'icon',
        'slug',
        'parent_id',
        'order',
        'is_active'
    ];

    /**
     * Parent menu relationship.
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Children menus relationship.
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    /**
     * Related page relationship (if menu links to a page).
     */
    public function page()
    {
        return $this->hasOne(Page::class);
    }

    /**
     * Roles assigned to this menu.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_role', 'menu_id', 'role_id');
    }
}
