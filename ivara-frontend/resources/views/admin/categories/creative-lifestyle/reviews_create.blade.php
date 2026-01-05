@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h1 class="h3 mb-4 text-gray-800">Add New Review</h1><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action' => route('admin.creative-lifestyle.reviews.store'), 'method' => 'POST', 'model' => null, 'entity' => 'Review'])
</div></div></div>
@endsection
