@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h1 class="h3 mb-4">Add New Service</h1><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.transport-travel.services.store'), 'method'=>'POST', 'model'=>null, 'entity'=>'Service'])
</div></div></div>
@endsection
