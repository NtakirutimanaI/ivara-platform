<?php

namespace App\Modules\CreativeLifestyle\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CreativeLifestyle\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->paginate(10);
        return view('admin.categories.creative-lifestyle.reviews', compact('reviews'));
    }

    public function create()
    {
        return view('admin.categories.creative-lifestyle.reviews_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        Review::create($validated);

        return redirect()->route('admin.creative-lifestyle.reviews')
            ->with('success', 'Review created successfully.');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('admin.categories.creative-lifestyle.reviews_edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        $review->update($validated);

        return redirect()->route('admin.creative-lifestyle.reviews')
            ->with('success', 'Review updated successfully.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.creative-lifestyle.reviews')
            ->with('success', 'Review deleted successfully.');
    }
}
