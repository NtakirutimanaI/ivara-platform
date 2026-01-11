@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>View Categories</h1>
            <p>Overview of all service categories on the IVARA Platform.</p>
        </div>
        <!-- Create New Disabled -->
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
                    @foreach($categories as $cat)
                    <tr>
                        <td>#{{ str_pad($cat['id'], 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="fw-bold">{{ $cat['name'] }}</td>
                        <td><code>{{ $cat['slug'] }}</code></td>
                        <td>
                            <span class="status-badge {{ isset($cat['status']) && $cat['status'] === 'Active' ? 'status-completed' : 'status-failed' }}">
                                {{ $cat['status'] ?? 'Active' }}
                            </span>
                        </td>
                        <td>{{ $cat['subs'] ?? 0 }} Types</td>
                        <td>{{ $cat['providers'] ?? 0 }} Active</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('super_admin.categories.edit', $cat['slug']) }}" class="icon-btn text-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                <!-- Delete Disabled -->
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
