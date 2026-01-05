@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h1 class="h3 mb-4 text-gray-800">Edit Provider</h1><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action' => route('admin.creative-lifestyle.providers.update', $provider->id), 'method' => 'PUT', 'model' => $provider, 'entity' => 'Provider'])
</div></div></div>
@endsection
