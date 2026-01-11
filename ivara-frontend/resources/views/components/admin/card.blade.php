@props(['title' => null, 'icon' => null, 'actions' => null])

<div {{ $attributes->merge(['class' => 'pro-card bg-white border shadow-sm p-4 rounded-4']) }}>
    @if($title)
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-light">
            <h5 class="fw-bold text-dark mb-0 d-flex align-items-center">
                @if($icon) 
                    <div class="icon-circle-sm me-3 text-primary bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="{{ $icon }}"></i> 
                    </div>
                @endif
                {{ $title }}
            </h5>
            @if($actions)
                <div class="d-flex gap-2">
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif
    
    <div>
        {{ $slot }}
    </div>
</div>
