@extends('layouts.app')

@section('title', 'Frequently Asked Questions - IVARA')

@section('content')
<div class="faq-header">
    <div class="container-custom">
        <h1>Help & FAQs</h1>
        <p>Find answers to common questions about setting up and managing your marketplace.</p>
    </div>
</div>

<div class="container-custom section-padding">
    <div class="faq-wrapper">
        @if(count($items) > 0)
            @foreach($items as $faq)
                <div class="faq-item">
                    <div class="faq-question">
                        {{ $faq['question'] }}
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>{{ $faq['answer'] }}</p>
                    </div>
                </div>
            @endforeach
        @else
             <div class="empty-state">
                <i class="fas fa-question-circle"></i>
                <h3>No FAQs available yet</h3>
            </div>
        @endif
    </div>
</div>

<style>
    .faq-header { background: #0A1128; color: white; padding: 120px 0 60px; text-align: center; }
    .section-padding { padding: 80px 20px; }
    
    .faq-wrapper { max-width: 800px; margin: 0 auto; }
    .faq-item { border-bottom: 1px solid #eee; margin-bottom: 15px; }
    
    .faq-question {
        padding: 20px; font-size: 1.1rem; font-weight: 700; color: #0A1128;
        cursor: pointer; display: flex; justify-content: space-between; align-items: center;
        background: #f8f9fa; border-radius: 8px; transition: 0.3s;
    }
    .faq-question:hover { background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    
    .faq-answer { display: none; padding: 20px; color: #666; line-height: 1.6; }
    .faq-item.active .faq-answer { display: block; }
    .faq-item.active .faq-question i { transform: rotate(45deg); }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqs = document.querySelectorAll('.faq-question');
        faqs.forEach(faq => {
            faq.addEventListener('click', () => {
                faq.parentElement.classList.toggle('active');
            });
        });
    });
</script>
@endsection
