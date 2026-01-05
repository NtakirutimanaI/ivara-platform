<?php

namespace App\Modules\EducationKnowledge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EducationKnowledgeController extends Controller
{
    protected $categoryName = 'Education & Knowledge';
    protected $categorySlug = 'education-knowledge';
    protected $categoryIcon = 'fa-graduation-cap';
    protected $categoryColor = '#9C27B0';

    public function index()
    {
        $stats = [
            'total_courses' => 0,
            'total_enrollments' => 0,
            'total_instructors' => 0,
            'total_students' => 0,
            'active_courses' => 0,
            'total_revenue' => 0,
        ];

        return view('admin.categories.education-knowledge.index', [
            'stats' => $stats,
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
            'categoryIcon' => $this->categoryIcon,
            'categoryColor' => $this->categoryColor,
        ]);
    }

    public function courses()
    {
        return view('admin.categories.education-knowledge.courses', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function enrollments()
    {
        return view('admin.categories.education-knowledge.enrollments', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function instructors()
    {
        return view('admin.categories.education-knowledge.instructors', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function materials()
    {
        return view('admin.categories.education-knowledge.materials', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function students()
    {
        return view('admin.categories.education-knowledge.students', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function reports()
    {
        return view('admin.categories.education-knowledge.reports', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function payments()
    {
        return view('admin.categories.education-knowledge.payments', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function reviews()
    {
        return view('admin.categories.education-knowledge.reviews', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function settings()
    {
        return view('admin.categories.education-knowledge.settings', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }
}
