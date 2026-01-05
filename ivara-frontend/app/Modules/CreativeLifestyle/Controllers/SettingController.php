<?php

namespace App\Modules\CreativeLifestyle\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CreativeLifestyle\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::latest()->paginate(10);
        return view('admin.categories.creative-lifestyle.settings', compact('settings'));
    }

    public function create()
    {
        return view('admin.categories.creative-lifestyle.settings_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        Setting::create($validated);

        return redirect()->route('admin.creative-lifestyle.settings')
            ->with('success', 'Setting created successfully.');
    }

    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('admin.categories.creative-lifestyle.settings_edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        $setting->update($validated);

        return redirect()->route('admin.creative-lifestyle.settings')
            ->with('success', 'Setting updated successfully.');
    }

    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();

        return redirect()->route('admin.creative-lifestyle.settings')
            ->with('success', 'Setting deleted successfully.');
    }
}
