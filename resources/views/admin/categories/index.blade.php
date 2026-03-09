@extends('layouts.app')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1 class="admin-title">Administrar Categorías</h1>

            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                + Crear Noticia
            </a>

        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            + Nueva Categoría
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td class="title-cell">{{ $category->name }}</td>
                    <td><code class="slug-code">{{ $category->slug }}</code></td>
                    <td>{{ Str::limit($category->description, 50) ?? '—' }}</td>
                    <td>
                        <span class="badge badge-info">
                            {{ $category->articles_count ?? 0 }} artículos
                        </span>
                    </td>
                    <td class="actions-cell">
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
                        <div class="empty-icon">📂</div>
                        <p>No hay categorías creadas aún</p>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mt-4">
                            Crear primera categoría
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $categories->links() }}
    </div>
</div>
@endsection