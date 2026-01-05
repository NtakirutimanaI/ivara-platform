<?php

namespace App\Modules\EducationKnowledge\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\EducationKnowledge\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() { $students = Student::latest()->paginate(10); return view('admin.categories.education-knowledge.students', compact('students')); }
    public function create() { return view('admin.categories.education-knowledge.students_create'); }
    public function store(Request $request) { Student::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.education-knowledge.students')->with('success','Created'); }
    public function edit($id) { $student = Student::findOrFail($id); return view('admin.categories.education-knowledge.students_edit', compact('student')); }
    public function update(Request $request, $id) { Student::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.education-knowledge.students')->with('success','Updated'); }
    public function destroy($id) { Student::findOrFail($id)->delete(); return redirect()->route('admin.education-knowledge.students')->with('success','Deleted'); }
}
