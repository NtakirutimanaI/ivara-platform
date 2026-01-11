@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Enable / Disable Categories</h1>
            <p>Control the visibility and accessibility of major service categories.</p>
        </div>
    </header>

    <div class="pro-card glass-panel">
        <p class="text-danger mb-4"><i class="fas fa-exclamation-triangle me-2"></i> Disabling a category will hide it from the marketplace and prevent new bookings.</p>
        
        <div class="row">
            @php
                 $categories = [
                    ['name' => 'Technical & Repair', 'slug' => 'technical-repair', 'active' => true, 'desc' => 'Hardware, plumbing, and mechanical repairs.'],
                    ['name' => 'Creative & Lifestyle', 'slug' => 'creative-lifestyle', 'active' => true, 'desc' => 'Crafts, arts, and lifestyle services.'],
                    ['name' => 'Transport & Travel', 'slug' => 'transport-travel', 'active' => true, 'desc' => 'Taxi, bus, moto, and truck logistics.'],
                    ['name' => 'Food, Fashion & Events', 'slug' => 'food-fashion-events', 'active' => true, 'desc' => 'Catering, tailoring, and event planning.'],
                    ['name' => 'Education & Knowledge', 'slug' => 'education-knowledge', 'active' => true, 'desc' => 'Tutorials, classes, and academic resources.'],
                    ['name' => 'Agriculture & Environment', 'slug' => 'agriculture-environment', 'active' => true, 'desc' => 'Farming services and environmental consulting.'],
                    ['name' => 'Media & Entertainment', 'slug' => 'media-entertainment', 'active' => true, 'desc' => 'Photography, videography, and content creation.'],
                    ['name' => 'Legal & Professional', 'slug' => 'legal-professional', 'active' => false, 'desc' => 'Lawyers, consultants, and advisors.'],
                    ['name' => 'Other Services', 'slug' => 'other-services', 'active' => true, 'desc' => 'Miscellaneous daily services.'],
                ];
            @endphp

            @foreach($categories as $cat)
            <div class="col-md-6 mb-4">
                <div class="p-3 border rounded d-flex justify-content-between align-items-center" style="background: rgba(255,255,255,0.05);">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-circle bg-primary text-white" style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">{{ $cat['name'] }}</h5>
                            <small class="text-muted">{{ $cat['desc'] }}</small>
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="cat_{{ $cat['slug'] }}" style="width: 50px; height: 25px;" {{ $cat['active'] ? 'checked' : '' }}>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
