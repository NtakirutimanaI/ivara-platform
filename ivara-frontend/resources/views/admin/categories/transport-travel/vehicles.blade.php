@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h1 class="h3 mb-4">Vehicles - Transport & Travel</h1><div class="card shadow"><div class="card-body">
<table class="table"><thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Actions</th></tr></thead><tbody>
@foreach($vehicles as $item) <tr><td>{{$item->id}}</td><td>{{$item->name}}</td><td>{{$item->price}}</td><td><a href="{{route('admin.transport-travel.vehicles.edit',$item->id)}}" class="btn btn-sm btn-info text-white">Edit</a></td></tr> @endforeach
</tbody></table>{{$vehicles->links()}}</div></div></div>
@endsection
