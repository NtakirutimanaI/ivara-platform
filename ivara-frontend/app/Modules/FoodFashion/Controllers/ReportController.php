<?php

namespace App\Modules\FoodFashion\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\FoodFashion\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index() { $reports = Report::latest()->paginate(10); return view('admin.categories.food-fashion.reports', compact('reports')); }
    public function create() { return view('admin.categories.food-fashion.reports_create'); }
    public function store(Request $request) { Report::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.food-fashion.reports')->with('success','Created'); }
    public function edit($id) { $report = Report::findOrFail($id); return view('admin.categories.food-fashion.reports_edit', compact('report')); }
    public function update(Request $request, $id) { Report::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.food-fashion.reports')->with('success','Updated'); }
    public function destroy($id) { Report::findOrFail($id)->delete(); return redirect()->route('admin.food-fashion.reports')->with('success','Deleted'); }
}
