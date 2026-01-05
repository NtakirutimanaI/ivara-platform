@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h1 class="h3 mb-4">Edit Vehicle</h1><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.transport-travel.vehicles.update',$vehicle->id), 'method'=>'PUT', 'model'=>$vehicle, 'entity'=>'Vehicle'])
</div></div></div>
@endsection
