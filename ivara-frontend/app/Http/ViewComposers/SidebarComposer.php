<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class SidebarComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = Auth::user();
        $role = $user ? $user->role : 'guest';
        
        $allMenus = config('sidebar.menus', []);
        $roleMenu = $allMenus[$role] ?? [];

        $view->with([
            'roleMenu' => $roleMenu,
            'currentRole' => $role,
        ]);
    }
}
