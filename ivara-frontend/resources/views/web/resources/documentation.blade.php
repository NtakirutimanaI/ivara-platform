@extends('layouts.app')

@section('title', $title . ' - IVARA Resources')

@section('content')
<div class="resource-header">
    <div class="container-custom">
        <h1 class="reveal-text">{{ $title }}</h1>
        <p class="reveal-text">Explore the latest insights, strategies, and updates from the IVARA ecosystem.</p>
    </div>
</div>

<div class="container-custom section-padding">
    @if(count($items) > 0)
        <div class="resource-grid">
            @foreach($items as $item)
                <a href="{{ route('resource.show', $item['slug']) }}" class="resource-card reveal-card">
                    <div class="res-card-img" style="background-image: url('{{ $item['coverImage'] ?? 'https://via.placeholder.com/400x250' }}')"></div>
                    <div class="res-card-body">
                        <span class="res-tag">{{ ucfirst($item['type']) }}</span>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ Str::limit($item['summary'], 100) }}</p>
                        <span class="read-more">Read Article <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-folder-open"></i>
            <h3>No content found</h3>
            <p>We are currently updating this section. Check back soon!</p>
        </div>
    @endif
</div>

<style>
    .resource-header { background: #0A1128; color: white; padding: 120px 0 60px; text-align: center; }
    .resource-header h1 { font-size: 3rem; font-weight: 800; margin-bottom: 20px; }
    .section-padding { padding: 80px 20px; }
    
    .resource-grid {
        display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px;
    }
    .resource-card {
        background: #fff; border-radius: 12px; overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05); transition: 0.3s;
        text-decoration: none; display: flex; flex-direction: column;
    }
    .resource-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    
    .res-card-img { height: 200px; background-size: cover; background-position: center; }
    .res-card-body { padding: 25px; display: flex; flex-direction: column; flex: 1; }
    
    .res-tag { 
        font-size: 0.75rem; font-weight: 700; color: #ffb700; text-transform: uppercase; margin-bottom: 10px; 
    }
    .resource-card h3 { color: #0A1128; font-size: 1.25rem; font-weight: 700; margin-bottom: 15px; }
    .resource-card p { color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 20px; flex: 1; }
    
    .read-more { color: #0A1128; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; gap: 5px; }
    
    .empty-state { text-align: center; padding: 100px 0; color: #999; }
    .empty-state i { font-size: 4rem; margin-bottom: 20px; opacity: 0.5; }
</style>
@endsection
