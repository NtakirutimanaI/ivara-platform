@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h1 class="h3 mb-4">Edit Service</h1><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.transport-travel.services.update',$service->id), 'method'=>'PUT', 'model'=>$service, 'entity'=>'Service'])
</div></div></div>
@endsection
