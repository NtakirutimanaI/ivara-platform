@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><div class="d-flex justify-content-between mb-4"><h3>Services - Technical & Repair</h3><a href="{{route('admin.technical-repair.services.create')}}" class="btn btn-primary">Add New</a></div><div class="card shadow"><div class="card-body">
<table class="table"><thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Actions</th></tr></thead><tbody>
@foreach($services as $item) <tr><td>{{$item->id}}</td><td>{{$item->name}}</td><td>{{$item->price}}</td><td><a href="{{route('admin.technical-repair.services.edit',$item->id)}}" class="btn btn-sm btn-info text-white">Edit</a></td></tr> @endforeach
</tbody></table>
        @if($services->isEmpty())
            <p class="text-center text-muted py-4">No services found. <a href="{{route('admin.technical-repair.services.create')}}">Add your first service</a></p>
        @endif
    </div></div></div>
@endsection
