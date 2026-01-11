@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>View Categories</h1>
            <p>Overview of all service categories on the IVARA Platform.</p>
        </div>
        <a href="{{ route('super_admin.categories.create') }}" class="btn-premium"><i class="fas fa-plus"></i> Create New</a>
    </header>

    <div class="pro-card glass-panel">
        <div class="table-responsive">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Sub-Categories</th>
                        <th>Providers</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $categories = [
                            ['id' => 1, 'name' => 'Technical & Repair', 'slug' => 'technical-repair', 'status' => 'Active', 'subs' => 12, 'providers' => 150],
                            ['id' => 2, 'name' => 'Creative & Lifestyle', 'slug' => 'creative-lifestyle', 'status' => 'Active', 'subs' => 8, 'providers' => 120],
                            ['id' => 3, 'name' => 'Transport & Travel', 'slug' => 'transport-travel', 'status' => 'Active', 'subs' => 8, 'providers' => 320],
                            ['id' => 4, 'name' => 'Food, Fashion & Events', 'slug' => 'food-fashion-events', 'status' => 'Active', 'subs' => 15, 'providers' => 210],
                            ['id' => 5, 'name' => 'Education & Knowledge', 'slug' => 'education-knowledge', 'status' => 'Active', 'subs' => 20, 'providers' => 95],
                            ['id' => 6, 'name' => 'Agriculture & Environment', 'slug' => 'agriculture-environment', 'status' => 'Active', 'subs' => 10, 'providers' => 400],
                            ['id' => 7, 'name' => 'Media & Entertainment', 'slug' => 'media-entertainment', 'status' => 'Active', 'subs' => 6, 'providers' => 60],
                            ['id' => 8, 'name' => 'Legal & Professional', 'slug' => 'legal-professional', 'status' => 'Inactive', 'subs' => 5, 'providers' => 45],
                            ['id' => 9, 'name' => 'Other Services', 'slug' => 'other-services', 'status' => 'Active', 'subs' => 4, 'providers' => 30],
                        ];
                    @endphp
                    @foreach($categories as $cat)
                    <tr>
                        <td>#{{ str_pad($cat['id'], 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="fw-bold">{{ $cat['name'] }}</td>
                        <td><code>{{ $cat['slug'] }}</code></td>
                        <td>
                            <span class="status-badge {{ $cat['status'] === 'Active' ? 'status-completed' : 'status-failed' }}">
                                {{ $cat['status'] }}
                            </span>
                        </td>
                        <td>{{ $cat['subs'] }} Types</td>
                        <td>{{ $cat['providers'] }} Active</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('super_admin.categories.edit', $cat['slug']) }}" class="icon-btn text-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                <button class="icon-btn text-danger" title="Delete"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
