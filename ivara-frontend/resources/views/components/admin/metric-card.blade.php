@props(['label', 'value', 'trend' => null, 'trendColor' => 'success', 'icon' => null])

<div class="metric-card h-100 bg-white border shadow-sm p-4 rounded-4 position-relative overflow-hidden">
    @if($icon)
        <div class="position-absolute top-0 end-0 p-3 opacity-10">
            <i class="{{ $icon }} fa-3x text-muted"></i>
        </div>
    @endif
    
    <span class="metric-title text-muted text-uppercase fw-bold fs-7 ls-1 mb-2 d-block">{{ $label }}</span>
    <div class="d-flex align-items-end justify-content-between">
        <h3 class="metric-value text-dark fw-bolder mb-0 display-6">{{ $value }}</h3>
        @if($trend)
            <span class="badge bg-{{ $trendColor }} bg-opacity-10 text-{{ $trendColor }} rounded-pill px-2 py-1">
                {{ $trend }}
            </span>
        @endif
    </div>
</div>
