@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h3>Edit Service</h3><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.technical-repair.services.update',$service->id), 'method'=>'PUT', 'model'=>$service, 'entity'=>'Service'])
</div></div></div>
@endsection
