@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Service - Creative & Lifestyle</h1>
        <a href="{{ route('admin.creative-lifestyle.services') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @include('admin.categories.partials.entity_form', [
                'action' => route('admin.creative-lifestyle.services.update', $service->id),
                'method' => 'PUT',
                'model' => $service,
                'entity' => 'Service'
            ])
        </div>
    </div>
</div>
@endsection
