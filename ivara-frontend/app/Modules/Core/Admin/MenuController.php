<?php

namespace App\Modules\Core\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Models\Menu;
use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MenuController extends Controller
{
    // Ensure only authenticated users can access this controller
   
    /**
     * Display a listing of menus along with roles.
     */
    public function index(): View
    {
        // Fetch top-level menus with their children and roles
        $menus = Menu::with(['children', 'roles'])->whereNull('parent_id')->orderBy('order')->get();

        // Fetch all roles for assigning to menus/pages
        $roles = Role::orderBy('name')->get();

        // Return the view with menus and roles
        return view('admin.menu', compact('menus', 'roles'));
    }

    /**
     * Store a newly created menu in storage.
     */
    public function store(StoreMenuRequest $request): RedirectResponse
    {
        // Create the menu
        $menu = Menu::create($request->validated());

        // Sync roles for access control
        $menu->roles()->sync($request->input('roles', []));

        return back()->with('success', 'Menu created successfully.');
    }

    /**
     * Update the specified menu in storage.
     */
    public function update(StoreMenuRequest $request, Menu $menu): RedirectResponse
    {
        // Update menu details
        $menu->update($request->validated());

        // Sync roles after update
        $menu->roles()->sync($request->input('roles', []));

        return back()->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified menu from storage.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        $menu->delete();
        return back()->with('success', 'Menu deleted successfully.');
    }
}
