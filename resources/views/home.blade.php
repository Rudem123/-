@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 fw-bold">Лента новостей</h1>
    
    <div class="row g-4">
        @foreach($articles as $article)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="/galery?img={{ $article['full_image'] }}">
                    <img src="{{ asset('img/' . $article['preview_image']) }}" 
                         class="card-img-top" 
                         style="height: 200px; object-fit: cover;" 
                         alt="{{ $article['name'] }}">
                </a>
                <div class="card-body">
                    <div class="text-muted small mb-2">{{ $article['date'] }}</div>
                    <h5 class="card-title fw-bold">{{ $article['name'] }}</h5>
                    <p class="card-text text-secondary">{{ $article['shortDesc'] ?? 'Читайте подробнее в полной версии статьи...' }}</p>
                </div>
                <div class="card-footer bg-transparent border-0 pb-3">
                    <a href="/galery?img={{ $article['full_image'] }}" class="btn btn-outline-primary btn-sm w-100">Посмотреть фото</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection