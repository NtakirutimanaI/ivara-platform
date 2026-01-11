@props(['status'])

@php
    $status = strtolower($status);
    $config = [
        'active' => ['color' => 'success', 'icon' => 'fa-check-circle'],
        'verified' => ['color' => 'success', 'icon' => 'fa-shield-alt'],
        'completed' => ['color' => 'success', 'icon' => 'fa-check'],
        'pending' => ['color' => 'warning', 'icon' => 'fa-clock'],
        'review' => ['color' => 'warning', 'icon' => 'fa-search'],
        'inactive' => ['color' => 'secondary', 'icon' => 'fa-ban'],
        'suspended' => ['color' => 'danger', 'icon' => 'fa-minus-circle'],
        'rejected' => ['color' => 'danger', 'icon' => 'fa-times-circle'],
    ];
    
    $settings = $config[$status] ?? ['color' => 'primary', 'icon' => 'fa-info-circle'];
    $color = $settings['color'];
    $icon = $settings['icon'];
@endphp

<span class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }} border border-{{ $color }} border-opacity-25 px-3 py-2 rounded-pill d-inline-flex align-items-center gap-2">
    <i class="fas {{ $icon }} fa-xs"></i>
    <span class="fw-bold">{{ ucfirst($status) }}</span>
</span>
