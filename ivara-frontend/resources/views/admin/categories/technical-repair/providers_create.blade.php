@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h3>Add New Provider</h3><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.technical-repair.providers.store'), 'method'=>'POST', 'model'=>null, 'entity'=>'Provider'])
</div></div></div>
@endsection
