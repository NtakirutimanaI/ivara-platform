@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h3>Edit Report</h3><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action'=>route('admin.technical-repair.reports.update',$report->id), 'method'=>'PUT', 'model'=>$report, 'entity'=>'Report'])
</div></div></div>
@endsection
