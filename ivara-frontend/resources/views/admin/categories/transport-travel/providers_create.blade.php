@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h1 class="h3 mb-4">Add New Provider</h1><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.transport-travel.providers.store'), 'method'=>'POST', 'model'=>null, 'entity'=>'Provider'])
</div></div></div>
@endsection
