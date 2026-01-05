@extends('layouts.app')
@section('content')
<div class="container-fluid py-4"><h1 class="h3 mb-4 text-gray-800">Edit Setting</h1><div class="card shadow"><div class="card-body">
@include('admin.categories.partials.entity_form', ['action' => route('admin.creative-lifestyle.settings.update', $setting->id), 'method' => 'PUT', 'model' => $setting, 'entity' => 'Setting'])
</div></div></div>
@endsection
