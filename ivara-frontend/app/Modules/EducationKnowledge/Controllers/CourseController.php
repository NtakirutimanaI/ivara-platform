<?php

namespace App\Modules\EducationKnowledge\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\EducationKnowledge\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() { $courses = Course::latest()->paginate(10); return view('admin.categories.education-knowledge.courses', compact('courses')); }
    public function create() { return view('admin.categories.education-knowledge.courses_create'); }
    public function store(Request $request) { Course::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.education-knowledge.courses')->with('success','Created'); }
    public function edit($id) { $course = Course::findOrFail($id); return view('admin.categories.education-knowledge.courses_edit', compact('course')); }
    public function update(Request $request, $id) { Course::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.education-knowledge.courses')->with('success','Updated'); }
    public function destroy($id) { Course::findOrFail($id)->delete(); return redirect()->route('admin.education-knowledge.courses')->with('success','Deleted'); }
}
