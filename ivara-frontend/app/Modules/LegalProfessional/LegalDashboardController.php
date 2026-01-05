<?php

namespace App\Modules\LegalProfessional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LegalDashboardController extends Controller
{
    public function client() { return view('categories.legal-professional.client.index'); }
    public function legalPro() { return view('categories.legal-professional.legal-pro.index'); }
    public function consultant() { return view('categories.legal-professional.consultant.index'); }
    public function legalFirm() { return view('categories.legal-professional.firm.index'); }
    public function regulator() { return view('categories.legal-professional.regulator.index'); }
    public function admin() { return view('categories.legal-professional.admin.index'); }
    public function index() { return $this->admin(); }


    public function generic() { return view('legal.generic'); }
}
