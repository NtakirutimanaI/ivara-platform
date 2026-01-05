<?php

namespace App\Modules\CreativeLifestyle\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CreativeLifestyle\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->paginate(10);
        return view('admin.categories.creative-lifestyle.reports', compact('reports'));
    }

    public function create()
    {
        return view('admin.categories.creative-lifestyle.reports_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        Report::create($validated);

        return redirect()->route('admin.creative-lifestyle.reports')
            ->with('success', 'Report created successfully.');
    }

    public function edit($id)
    {
        $report = Report::findOrFail($id);
        return view('admin.categories.creative-lifestyle.reports_edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        $report->update($validated);

        return redirect()->route('admin.creative-lifestyle.reports')
            ->with('success', 'Report updated successfully.');
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('admin.creative-lifestyle.reports')
            ->with('success', 'Report deleted successfully.');
    }
}
