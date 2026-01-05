<?php

namespace App\Modules\OtherServices\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\OtherServices\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index() { $reviews = Review::latest()->paginate(10); return view('admin.categories.other-services.reviews', compact('reviews')); }
    public function create() { return view('admin.categories.other-services.reviews_create'); }
    public function store(Request $request) { Review::create($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.other-services.reviews')->with('success','Created'); }
    public function edit($id) { $review = Review::findOrFail($id); return view('admin.categories.other-services.reviews_edit', compact('review')); }
    public function update(Request $request, $id) { Review::findOrFail($id)->update($request->validate(['name'=>'required','description'=>'nullable','price'=>'nullable|numeric','status'=>'required'])); return redirect()->route('admin.other-services.reviews')->with('success','Updated'); }
    public function destroy($id) { Review::findOrFail($id)->delete(); return redirect()->route('admin.other-services.reviews')->with('success','Deleted'); }
}
