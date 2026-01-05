<?php

namespace App\Modules\EducationKnowledge\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\EducationKnowledge\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index() { $enrollments = Enrollment::latest()->paginate(10); return view('admin.categories.education-knowledge.enrollments', compact('enrollments')); }
    public function create() { return view('admin.categories.education-knowledge.enrollments_create'); }
    public function store(Request $request) { Enrollment::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.education-knowledge.enrollments')->with('success','Created'); }
    public function edit($id) { $enrollment = Enrollment::findOrFail($id); return view('admin.categories.education-knowledge.enrollments_edit', compact('enrollment')); }
    public function update(Request $request, $id) { Enrollment::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.education-knowledge.enrollments')->with('success','Updated'); }
    public function destroy($id) { Enrollment::findOrFail($id)->delete(); return redirect()->route('admin.education-knowledge.enrollments')->with('success','Deleted'); }
}
