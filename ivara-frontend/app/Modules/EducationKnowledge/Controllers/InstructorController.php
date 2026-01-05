<?php

namespace App\Modules\EducationKnowledge\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\EducationKnowledge\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index() { $instructors = Instructor::latest()->paginate(10); return view('admin.categories.education-knowledge.instructors', compact('instructors')); }
    public function create() { return view('admin.categories.education-knowledge.instructors_create'); }
    public function store(Request $request) { Instructor::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.education-knowledge.instructors')->with('success','Created'); }
    public function edit($id) { $instructor = Instructor::findOrFail($id); return view('admin.categories.education-knowledge.instructors_edit', compact('instructor')); }
    public function update(Request $request, $id) { Instructor::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.education-knowledge.instructors')->with('success','Updated'); }
    public function destroy($id) { Instructor::findOrFail($id)->delete(); return redirect()->route('admin.education-knowledge.instructors')->with('success','Deleted'); }
}
