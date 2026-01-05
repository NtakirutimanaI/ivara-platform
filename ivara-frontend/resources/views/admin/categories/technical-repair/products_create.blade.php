@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h3>Add New Product</h3><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.technical-repair.products.store'), 'method'=>'POST', 'model'=>null, 'entity'=>'Product'])
</div></div></div>
@endsection
