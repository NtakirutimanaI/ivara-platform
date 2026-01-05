@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h3>Edit Provider</h3><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.technical-repair.providers.update',$provider->id), 'method'=>'PUT', 'model'=>$provider, 'entity'=>'Provider'])
</div></div></div>
@endsection
