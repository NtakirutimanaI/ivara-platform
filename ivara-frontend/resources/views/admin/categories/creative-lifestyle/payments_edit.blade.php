@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h1 class="h3 mb-4 text-gray-800">Edit Payment</h1><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action' => route('admin.creative-lifestyle.payments.update', $payment->id), 'method' => 'PUT', 'model' => $payment, 'entity' => 'Payment'])
</div></div></div>
@endsection
