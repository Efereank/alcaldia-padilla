@extends('layouts.app')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1 class="admin-title">Administrar Categorías</h1>
        <div class="header-buttons">
            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
                Volver a Noticias
            </a>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                + Nueva Categoría
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Slug</th>
                    <th>Descripción</th>
                    <th>Artículos</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td data-label="ID">{{ $category->id }}</td>
                    <td data-label="Nombre" class="title-cell">{{ $category->name }}</td>
                    <td data-label="Slug"><code class="slug-code">{{ $category->slug }}</code></td>
                    <td data-label="Descripción">{{ Str::limit($category->description, 50) ?? '—' }}</td>
                    <td data-label="Artículos">
                        <span class="badge badge-info">
                            {{ $category->articles_count ?? 0 }} artículos
                        </span>
                    </td>
                    <td data-label="Acciones" class="actions-cell">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn-edit">
                            Editar
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="delete-form">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('¿Eliminar esta categoría? Los artículos quedarán sin categoría')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state">
                        <div class="empty-state-content">
                            <div class="empty-icon">📂</div>
                            <p class="empty-message">No hay categorías creadas aún</p>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                                Crear primera categoría
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($categories->hasPages())
    <div class="pagination-wrapper">
        {{ $categories->links() }}
    </div>
    @endif
</div>
@endsection