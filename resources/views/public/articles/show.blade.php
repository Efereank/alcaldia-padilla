@extends('layouts.app')

@section('content')
<div class="article-show-container">
    <!-- Contenido principal + Sidebar -->
    <div class="article-layout">
        <!-- Columna principal (artículo) -->
        <div class="article-main">
            <article class="article-card">
                <!-- Imagen destacada -->
                @if($article->image)
                <div class="article-image-container">
                    <img src="{{ Storage::url($article->image) }}" 
                         alt="{{ $article->title }}"
                         class="article-image-full">
                </div>
                @endif
                
                <!-- Contenido -->
                <div class="article-content-wrapper">
                    <!-- Migas de pan -->
                    <div class="breadcrumb">
                        <a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a>
                        <span class="breadcrumb-separator">›</span>
                        <span class="breadcrumb-current">{{ $article->category->name ?? 'Noticias' }}</span>
                    </div>
                    
                    <!-- Título -->
                    <h1 class="article-title-full">{{ $article->title }}</h1>
                    
                    <!-- Meta información -->
                    <div class="article-meta-full">
                        <div class="meta-item">
                            <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ $article->user->name ?? 'Administrador' }}
                        </div>
                        <div class="meta-item">
                            <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $article->published_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="meta-item">
                            <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ $article->views }} vistas
                        </div>
                    </div>
                    
                    <!-- Extracto -->
                    @if($article->excerpt)
                    <div class="article-excerpt-full">
                        {{ $article->excerpt }}
                    </div>
                    @endif
                    
                    <!-- Cuerpo de la noticia -->
                    <div class="article-body-full">
                        {!! nl2br(e($article->body)) !!}
                    </div>
                    
                    <!-- Botón para volver -->
                    <div class="article-footer-full">
                        <a href="{{ route('home') }}" class="back-button">
                            <svg class="back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver a todas las noticias
                        </a>
                    </div>
                </div>
            </article>
        </div>

        <!-- Sidebar con noticias relacionadas -->
        <aside class="article-sidebar">
            <div class="sidebar-widget">
                <h3 class="sidebar-title">Noticias relacionadas</h3>
                
                @if($relatedArticles->count() > 0)
                    <div class="related-articles-list">
                        @foreach($relatedArticles as $related)
                        <div class="related-article-item">
                            @if($related->image)
                            <div class="related-article-image">
                                <img src="{{ Storage::url($related->image) }}" 
                                     alt="{{ $related->title }}">
                            </div>
                            @endif
                            <div class="related-article-content">
                                <h4 class="related-article-title">
                                    <a href="{{ route('article.show', $related->slug) }}" class="related-article-link">
                                        {{ $related->title }}
                                    </a>
                                </h4>
                                <div class="related-article-date">
                                    {{ $related->published_at->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="sidebar-empty">No hay noticias relacionadas</p>
                @endif
            </div>

            <div class="sidebar-widget">
                <h3 class="sidebar-title">Categorías</h3>
                <ul class="sidebar-categories">
                    @php
                        use App\Models\Category;
                        $categories = Category::withCount('articles')->get();
                    @endphp
                    @foreach($categories as $category)
                    <li class="sidebar-category-item">
                        <a href="{{ route('category.articles', $category) }}" class="sidebar-category-link">
                            {{ $category->name }}
                            <span class="category-count">{{ $category->articles_count }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>


    <!-- ===== SECCIÓN DE SERVICIOS ESTILO FOTO ===== -->
<div class="services-photo-section">
    <div class="services-photo-grid">
        <!-- Servicios en Línea -->
        <div class="service-photo-card-1">
            <h3 class="service-photo-title">Servicios en Línea</h3>
            <p class="service-photo-description">Realiza tus trámites desde la comodidad de tu hogar</p>
            <a href="#" class="service-photo-button">Acceder</a>
        </div>

        <!-- Participa y Opina -->
        <div class="service-photo-card-2">
            <h3 class="service-photo-title">Participa y Opina</h3>
            <p class="service-photo-description">Tu voz es importante para transformar nuestro municipio</p>
            <a href="#" class="service-photo-button">Participar</a>
        </div>

        <!-- Calendario de Eventos -->
        <div class="service-photo-card-3">
            <h3 class="service-photo-title">Calendario de Eventos</h3>
            <p class="service-photo-description">Conoce las actividades programadas en tu comunidad</p>
            <a href="#" class="service-photo-button">Ver Eventos</a>
        </div>
    </div>
</div>
</div>
@endsection