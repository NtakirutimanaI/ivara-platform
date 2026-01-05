@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h3>Edit Product</h3><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.technical-repair.products.update',$product->id), 'method'=>'PUT', 'model'=>$product, 'entity'=>'Product'])
</div></div></div>
@endsection
