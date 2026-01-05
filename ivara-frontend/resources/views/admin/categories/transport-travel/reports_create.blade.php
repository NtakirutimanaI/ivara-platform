@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h1 class="h3 mb-4">Add New Report</h1><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.transport-travel.reports.store'), 'method'=>'POST', 'model'=>null, 'entity'=>'Report'])
</div></div></div>
@endsection
