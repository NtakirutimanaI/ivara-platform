<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Education & Knowledge Routes
|--------------------------------------------------------------------------
*/

// --- Management (Shared - Dashed Names) ---
Route::middleware(['auth', 'ivara_role:admin', 'category_access:education-knowledge'])
    ->prefix('admin/education-knowledge')->name('admin.education-knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.admin.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:manager', 'category_access:education-knowledge'])
    ->prefix('manager/education-knowledge')->name('manager.education-knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.manager.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:supervisor', 'category_access:education-knowledge'])
    ->prefix('supervisor/education-knowledge')->name('supervisor.education-knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.supervisor.index'); })->name('index');
});

// --- Teaching & Training (Unique - Underscore Names) ---
Route::middleware(['auth', 'ivara_role:instructor_teacher', 'category_access:education-knowledge'])
    ->prefix('instructor/dashboard')->name('instructor.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.service-provider.teaching-training.instructor-teacher.index'); })->name('index');
    Route::get('/classes', function () { return view('categories.education-knowledge.service-provider.teaching-training.instructor-teacher.index'); })->name('classes');
});

Route::middleware(['auth', 'ivara_role:trainer', 'category_access:education-knowledge'])
    ->prefix('trainer/dashboard')->name('trainer.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.service-provider.teaching-training.trainer.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:lecturer', 'category_access:education-knowledge'])
    ->prefix('lecturer/dashboard')->name('lecturer.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.service-provider.teaching-training.lecturer.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:tutor_mentor', 'category_access:education-knowledge'])
    ->prefix('tutor/dashboard')->name('tutor.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.service-provider.teaching-training.tutor-mentor.index'); })->name('index');
});

// --- Content & Knowledge (Unique - Underscore Names) ---
Route::middleware(['auth', 'ivara_role:educational_content_creator', 'category_access:education-knowledge'])
    ->prefix('content-creator/dashboard')->name('content_creator.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.service-provider.content-knowledge.educational-content-creator.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:curriculum_developer', 'category_access:education-knowledge'])
    ->prefix('curriculum-dev/dashboard')->name('curriculum_dev.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.service-provider.content-knowledge.curriculum-developer.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:knowledge_publisher', 'category_access:education-knowledge'])
    ->prefix('publisher/dashboard')->name('publisher.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.service-provider.content-knowledge.knowledge-publisher.index'); })->name('index');
});

// --- Research & Academic (Unique - Underscore Names) ---
Route::middleware(['auth', 'ivara_role:researcher', 'category_access:education-knowledge'])
    ->prefix('researcher/dashboard')->name('researcher.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.service-provider.research-academic.researcher.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:academic_writer', 'category_access:education-knowledge'])
    ->prefix('writer/dashboard')->name('academic_writer.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.service-provider.research-academic.academic-writer.index'); })->name('index');
});

// --- Support Providers (Unique - Underscore Names) ---
Route::middleware(['auth', 'ivara_role:academic_advisor', 'category_access:education-knowledge'])
    ->prefix('advisor/dashboard')->name('academic_advisor.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.support-provider.academic-advisory.academic-advisor.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:career_guidance', 'category_access:education-knowledge'])
    ->prefix('career-guidance/dashboard')->name('career_guidance.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.support-provider.academic-advisory.career-guidance.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:examiner', 'category_access:education-knowledge'])
    ->prefix('examiner/dashboard')->name('examiner.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.support-provider.assessment-quality.examiner.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:assessor', 'category_access:education-knowledge'])
    ->prefix('assessor/dashboard')->name('assessor.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.support-provider.assessment-quality.assessor.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:quality_assurance', 'category_access:education-knowledge'])
    ->prefix('qa/dashboard')->name('quality_assurance.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.support-provider.assessment-quality.quality-assurance.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:compliance_review', 'category_access:education-knowledge'])
    ->prefix('compliance/dashboard')->name('compliance_review.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.support-provider.moderation-compliance.compliance-review.index'); })->name('index');
});

// --- Shared Support Roles (Underscore Names) ---
Route::middleware(['auth', 'ivara_role:moderator', 'category_access:education-knowledge'])
    ->prefix('moderator/education-knowledge')->name('moderator.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.support-provider.moderation-compliance.moderator.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:mediator', 'category_access:education-knowledge'])
    ->prefix('mediator/education-knowledge')->name('mediator.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.mediator.index'); })->name('index');
});

// --- Businessperson (Unique - Underscore Names) ---
Route::middleware(['auth', 'ivara_role:school_institution_owner', 'category_access:education-knowledge'])
    ->prefix('school-owner/dashboard')->name('school_owner.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.businessperson.school-institution-owner.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:training_center_owner', 'category_access:education-knowledge'])
    ->prefix('training-owner/dashboard')->name('training_owner.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.businessperson.training-center-owner.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:education_business', 'category_access:education-knowledge'])
    ->prefix('edu-business/dashboard')->name('edu_business.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.businessperson.education-business.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:publishing_business', 'category_access:education-knowledge'])
    ->prefix('pub-business/dashboard')->name('publishing_business.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.businessperson.publishing-business.index'); })->name('index');
});

// --- Clients (Unique - Underscore Names) ---
Route::middleware(['auth', 'ivara_role:student_learner', 'category_access:education-knowledge'])
    ->prefix('student/dashboard')->name('student.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.client.student-learner.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:parent_guardian', 'category_access:education-knowledge'])
    ->prefix('parent/dashboard')->name('parent.education_knowledge.')->group(function () {
    Route::get('/', function () { return view('categories.education-knowledge.client.parent-guardian.index'); })->name('index');
});
