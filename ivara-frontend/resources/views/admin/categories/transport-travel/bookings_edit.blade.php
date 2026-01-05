@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h1 class="h3 mb-4">Edit Booking</h1><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.transport-travel.bookings.update',$booking->id), 'method'=>'PUT', 'model'=>$booking, 'entity'=>'Booking'])
</div></div></div>
@endsection
