<?php

namespace App\Modules\EducationKnowledge\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\EducationKnowledge\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index() { $materials = Material::latest()->paginate(10); return view('admin.categories.education-knowledge.materials', compact('materials')); }
    public function create() { return view('admin.categories.education-knowledge.materials_create'); }
    public function store(Request $request) { Material::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.education-knowledge.materials')->with('success','Created'); }
    public function edit($id) { $material = Material::findOrFail($id); return view('admin.categories.education-knowledge.materials_edit', compact('material')); }
    public function update(Request $request, $id) { Material::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.education-knowledge.materials')->with('success','Updated'); }
    public function destroy($id) { Material::findOrFail($id)->delete(); return redirect()->route('admin.education-knowledge.materials')->with('success','Deleted'); }
}
