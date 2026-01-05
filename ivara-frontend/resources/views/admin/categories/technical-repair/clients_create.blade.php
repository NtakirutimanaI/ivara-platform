@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h3>Add New Client</h3><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.technical-repair.clients.store'), 'method'=>'POST', 'model'=>null, 'entity'=>'Client'])
</div></div></div>
@endsection
