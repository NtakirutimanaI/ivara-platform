@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h3>Add New Booking</h3><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.technical-repair.bookings.store'), 'method'=>'POST', 'model'=>null, 'entity'=>'Booking'])
</div></div></div>
@endsection
