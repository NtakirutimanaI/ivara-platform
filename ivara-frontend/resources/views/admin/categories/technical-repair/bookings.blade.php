@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><div class="d-flex justify-content-between mb-4"><h3>Bookings - Technical & Repair</h3><a href="{{route('admin.technical-repair.bookings.create')}}" class="btn btn-primary">Add New</a></div><div class="card shadow"><div class="card-body">
<table class="table"><thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Actions</th></tr></thead><tbody>
@foreach($bookings as $item) <tr><td>{{$item->id}}</td><td>{{$item->name}}</td><td>{{$item->price}}</td><td><a href="{{route('admin.technical-repair.bookings.edit',$item->id)}}" class="btn btn-sm btn-info text-white">Edit</a></td></tr> @endforeach
</tbody></table>{{$bookings->links()}}</div></div></div>
@endsection
