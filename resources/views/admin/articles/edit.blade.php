@extends('layouts.app')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1 class="admin-title">Editar Noticia</h1>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
            ← Volver
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="error-list">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container">
        <form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data" class="admin-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title" class="form-label">Título <span class="required">*</span></label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title', $article->title) }}" 
                       class="form-input @error('title') is-invalid @enderror" 
                       required>
                @error('title')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug" class="form-label">Slug (URL) <span class="required">*</span></label>
                <input type="text" 
                       id="slug" 
                       name="slug" 
                       value="{{ old('slug', $article->slug) }}" 
                       class="form-input @error('slug') is-invalid @enderror" 
                       required>
                <small class="form-help">Ej: nueva-ley-de-presupuesto</small>
                @error('slug')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label for="category_id" class="form-label">Categoría <span class="required">*</span></label>
                    <select id="category_id" 
                            name="category_id" 
                            class="form-select @error('category_id') is-invalid @enderror" 
                            required>
                        <option value="">Seleccione una categoría</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group half">
                    <label for="status" class="form-label">Estado</label>
                    <select id="status" name="status" class="form-select">
                        <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Borrador</option>
                        <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Publicado</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="excerpt" class="form-label">Extracto (Resumen)</label>
                <textarea id="excerpt" 
                          name="excerpt" 
                          rows="3" 
                          class="form-textarea @error('excerpt') is-invalid @enderror">{{ old('excerpt', $article->excerpt) }}</textarea>
                @error('excerpt')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="body" class="form-label">Contenido <span class="required">*</span></label>
                <textarea id="body" 
                          name="body" 
                          rows="10" 
                          class="form-textarea @error('body') is-invalid @enderror" 
                          required>{{ old('body', $article->body) }}</textarea>
                @error('body')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            @if($article->image)
            <div class="form-group">
                <label class="form-label">Imagen actual</label>
                <div class="current-image">
                    <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="preview-image">
                </div>
            </div>
            @endif

            <div class="form-group">
                <label for="image" class="form-label">Nueva imagen destacada</label>
                <div class="file-input-wrapper">
                    <input type="file" 
                           id="image" 
                           name="image" 
                           class="file-input @error('image') is-invalid @enderror" 
                           accept="image/*">
                    <span class="file-input-label">Seleccionar archivo</span>
                </div>
                <small class="form-help">Formatos: JPG, PNG, GIF. Máximo 2MB</small>
                @error('image')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="published_at" class="form-label">Fecha de publicación</label>
                <input type="datetime-local" 
                       id="published_at" 
                       name="published_at" 
                       value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}" 
                       class="form-input @error('published_at') is-invalid @enderror">
                @error('published_at')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    Actualizar Noticia
                </button>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection