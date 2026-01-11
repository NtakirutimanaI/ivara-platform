@props(['title', 'subtitle' => ''])

<div {{ $attributes->merge(['class' => 'pro-header mb-5']) }}>
    <div>
        <h1 class="mb-0 fw-bold text-dark">{{ $title }}</h1>
        @if($subtitle)
            <p class="text-muted mb-0 mt-1">{{ $subtitle }}</p>
        @endif
    </div>
    <div class="d-flex gap-3 align-items-center">
        {{ $slot }}
    </div>
</div>
