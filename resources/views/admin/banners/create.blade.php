@extends('layouts.app')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1 class="admin-title">Crear Nuevo Banner</h1>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
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
        <form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data" class="admin-form">
            @csrf

            <div class="form-group">
                <label for="title" class="form-label">Título</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}" 
                       class="form-input @error('title') is-invalid @enderror">
                <small class="form-help">Título principal del banner (opcional)</small>
                @error('title')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="subtitle" class="form-label">Subtítulo</label>
                <input type="text" 
                       id="subtitle" 
                       name="subtitle" 
                       value="{{ old('subtitle') }}" 
                       class="form-input @error('subtitle') is-invalid @enderror">
                <small class="form-help">Subtítulo o descripción breve (opcional)</small>
                @error('subtitle')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Imagen <span class="required">*</span></label>
                <div class="file-input-wrapper">
                    <input type="file" 
                           id="image" 
                           name="image" 
                           class="file-input @error('image') is-invalid @enderror" 
                           accept="image/*"
                           required>
                    <span class="file-input-label">Seleccionar imagen</span>
                </div>
                <small class="form-help">Formatos: JPG, PNG, GIF. Tamaño recomendado: 1920x1080px</small>
                @error('image')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="link" class="form-label">Enlace</label>
                <input type="url" 
                       id="link" 
                       name="link" 
                       value="{{ old('link') }}" 
                       class="form-input @error('link') is-invalid @enderror"
                       placeholder="https://ejemplo.com">
                <small class="form-help">URL a donde redirigirá el banner (opcional)</small>
                @error('link')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label for="order" class="form-label">Orden</label>
                    <input type="number" 
                           id="order" 
                           name="order" 
                           value="{{ old('order', 0) }}" 
                           class="form-input @error('order') is-invalid @enderror"
                           min="0">
                    <small class="form-help">Número para ordenar los banners</small>
                    @error('order')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group half">
                    <label for="is_active" class="form-label">Estado</label>
                    <select id="is_active" name="is_active" class="form-select">
                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    <small class="form-help">Solo los banners activos se muestran</small>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    Guardar Banner
                </button>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection