@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h3>Edit Client</h3><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.technical-repair.clients.update',$client->id), 'method'=>'PUT', 'model'=>$client, 'entity'=>'Client'])
</div></div></div>
@endsection
