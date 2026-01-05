<?php

namespace App\Modules\EducationKnowledge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EducationDashboardController extends Controller
{
    public function student() { return view('education.student.index'); }
    public function teacher() { return view('education.teacher.index'); }
    public function tutor() { return view('education.tutor.index'); }
    public function contentCreator() { return view('education.content_creator.index'); }
    public function institutionAdmin() { return view('education.institution.index'); }
    public function eduAdmin() { return view('education.admin.index'); }

    // Generic dashboard for education roles
    public function generic() { return view('education.generic'); }
}
