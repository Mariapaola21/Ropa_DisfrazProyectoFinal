@extends('adminlte::page')

@section('title', 'Inventario')

@section('content_header')
    <h1 style="color:#2c3e50;"><i class="fas fa-box"></i> Inventario</h1>
@stop

@section('content')

<div class="row" style="display:flex; gap:20px;">
    {{-- 📌 FORMULARIO CREAR --}}
    <div style="flex:1;">
        <div class="card">
            <h5>Agregar nuevo disfraz</h5>
            <form action="{{ route('inventario.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="nombre" placeholder="Nombre" required>
                <textarea name="descripcion" placeholder="Descripción"></textarea>
                <input type="number" name="precio" placeholder="Precio" required>
                <select name="talla" required>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>
                <input type="number" name="cantidad" placeholder="Cantidad" required>
                <input type="file" name="imagen" accept="image/*">
                <button type="submit" class="btn-dark" style="width:100%;">Agregar</button>
            </form>
        </div>
    </div>

    {{-- 📌 LISTADO --}}
    <div style="flex:2;">
        <div class="card">
            <h5>Listado de disfraces</h5>
            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Talla</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($disfraces as $d)
                        <tr>
                            <td>
                                @if($d->imagen)
                                    <img src="{{ asset('storage/'.$d->imagen) }}" width="60">
                                @else
                                    <span style="color:gray;">Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $d->nombre }}</td>
                            <td>{{ $d->descripcion }}</td>
                            <td>${{ number_format($d->precio, 0, ',', '.') }}</td>
                            <td>{{ $d->talla }}</td>
                            <td>{{ $d->cantidad }}</td>
                            <td>
                                {{-- ✏️ Botón Editar --}}
                                <button type="button" class="btn-warning" onclick="openModal({{ $d->id }})">
                                    Editar
                                </button>

                                {{-- 📝 Modal Editar --}}
                                <div id="modal{{ $d->id }}" class="modal">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Editar disfraz: {{ $d->nombre }}</h5>
                                            <span class="close" onclick="closeModal({{ $d->id }})">&times;</span>
                                        </div>
                                        <form action="{{ route('inventario.update', $d->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" name="nombre" value="{{ $d->nombre }}" required>
                                            <input type="number" name="precio" value="{{ $d->precio }}" required>
                                            <textarea name="descripcion">{{ $d->descripcion }}</textarea>
                                            <select name="talla" required>
                                                <option value="S" {{ $d->talla == 'S' ? 'selected' : '' }}>S</option>
                                                <option value="M" {{ $d->talla == 'M' ? 'selected' : '' }}>M</option>
                                                <option value="L" {{ $d->talla == 'L' ? 'selected' : '' }}>L</option>
                                                <option value="XL" {{ $d->talla == 'XL' ? 'selected' : '' }}>XL</option>
                                            </select>
                                            <input type="number" name="cantidad" value="{{ $d->cantidad }}" required>
                                            <input type="file" name="imagen" accept="image/*">
                                            @if($d->imagen)
                                                <img src="{{ asset('storage/'.$d->imagen) }}" width="100" style="margin-top:10px;">
                                            @endif
                                            <button type="submit" class="btn-success" style="width:100%; margin-top:10px;">Guardar cambios</button>
                                        </form>
                                    </div>
                                </div>

                                {{-- 🗑️ Eliminar --}}
                                <form action="{{ route('inventario.destroy', $d->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este disfraz?')">
                                        Eliminar
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

{{-- 🔹 Script --}}
<script>
    // Abrir modal
    function openModal(id) {
        document.getElementById('modal' + id).style.display = 'flex';
    }
    // Cerrar modal
    function closeModal(id) {
        document.getElementById('modal' + id).style.display = 'none';
    }
</script>

{{-- 🔹 Estilos (mantenidos dentro de la vista) --}}
<style>
    .card { background: #fff; border-radius: 10px; padding: 15px; margin-bottom: 20px; }
    h5 { margin-bottom: 10px; }
    input, textarea, select { width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 6px; }
    button { padding: 8px 14px; border: none; border-radius: 6px; cursor: pointer; }
    .btn-dark { background: #2c3e50; color: white; }
    .btn-warning { background: #f39c12; color: white; }
    .btn-danger { background: #e74c3c; color: white; }
    .btn-success { background: #27ae60; color: white; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
    th { background: #2c3e50; color: white; }
    img { border-radius: 6px; }
    /* Modal */
    .modal { display: none; position: fixed; z-index: 999; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); justify-content: center; align-items: center; }
    .modal-content { background: white; padding: 20px; border-radius: 10px; width: 500px; max-width: 90%; }
    .modal-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; margin-bottom: 10px; }
    .close { cursor: pointer; font-size: 18px; }
</style>
@stop
