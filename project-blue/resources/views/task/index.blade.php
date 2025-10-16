@extends('templates.base')

@section('title', 'Tareas')
@section('subtitle', 'Listado de todas las tareas')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Nueva Tarea
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Proyecto</th>
                        <th>Estado</th>
                        <th>Fecha Vencimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->project->title ?? 'N/A' }}</td>
                        <td>
                            @if($task->status == 'completado')
                                <span class="badge badge-success">Completado</span>
                            @elseif($task->status == 'pendiente')
                                <span class="badge badge-warning">Pendiente</span>
                            @else
                                <span class="badge badge-danger">Cancelado</span>
                            @endif
                        </td>
                        <td>{{ $task->due_date }}</td>
                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-info btn-sm" title="Editar">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-delete" title="Eliminar">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        showSuccess('{{ session('success') }}');
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        showError('{{ session('error') }}');
    });
</script>
@endif
@endsection

