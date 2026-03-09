@extends('layouts.app')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1 class="admin-title">Crear Nueva Categoría</h1>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
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
        <form method="POST" action="{{ route('admin.categories.store') }}" class="admin-form">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Nombre <span class="required">*</span></label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}" 
                       class="form-input @error('name') is-invalid @enderror" 
                       required>
                @error('name')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug" class="form-label">Slug (URL) <span class="required">*</span></label>
                <input type="text" 
                       id="slug" 
                       name="slug" 
                       value="{{ old('slug') }}" 
                       class="form-input @error('slug') is-invalid @enderror" 
                       required>
                <small class="form-help">Ej: noticias-municipales, eventos-culturales</small>
                @error('slug')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Descripción</label>
                <textarea id="description" 
                          name="description" 
                          rows="4" 
                          class="form-textarea @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                <small class="form-help">Breve descripción de la categoría (opcional)</small>
                @error('description')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    Guardar Categoría
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection