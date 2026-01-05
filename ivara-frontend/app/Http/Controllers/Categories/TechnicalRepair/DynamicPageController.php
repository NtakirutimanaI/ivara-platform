<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DynamicPageController extends Controller
{
    /**
     * Display a dynamic page based on menu slug.
     *
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        // Fetch the menu along with its page and roles, only if active
        $menu = Menu::with(['page', 'roles'])
                    ->where('slug', $slug)
                    ->where('is_active', true)
                    ->firstOrFail();

        // Authorization: user must have at least one role attached to this menu, or be admin
        if (!auth()->check()) {
            abort(403, 'Unauthorized access');
        }

        $user = auth()->user();

        // Check if user has any role matching the menu roles
        $hasAccess = $menu->roles->pluck('name')->some(fn($role) => $user->hasRole($role));

        if (!$hasAccess && !$user->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

        // Return the dynamic page view
        return view('page.show', [
            'menu' => $menu,
            'page' => $menu->page
        ]);
    }
}
