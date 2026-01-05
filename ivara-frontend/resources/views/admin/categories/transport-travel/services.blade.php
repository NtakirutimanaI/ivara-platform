@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><div class="d-flex justify-content-between align-items-center mb-4"><h1 class="h3">Services - Transport & Travel</h1><a href="{{ route('admin.transport-travel.services.create') }}" class="btn btn-primary">Add New</a></div><div class="card shadow"><div class="card-body">
<table class="table"><thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Actions</th></tr></thead><tbody>
@foreach($services as $item) <tr><td>{{$item->id}}</td><td>{{$item->name}}</td><td>{{$item->price}}</td><td><a href="{{route('admin.transport-travel.services.edit',$item->id)}}" class="btn btn-sm btn-info text-white">Edit</a></td></tr> @endforeach
</tbody></table>{{$services->links()}}</div></div></div>
@endsection
