@extends('adminlte::page')

@section('title', 'Historial de Reservas')

@section('content_header')
    <h1 class="text-center mb-4" style="font-size: 2.2rem; background: linear-gradient(90deg, #6a11cb, #2575fc); 
        -webkit-background-clip: text; color: transparent; font-weight: bold; text-shadow: 1px 1px 4px rgba(0,0,0,0.3);">
        📋 Historial de Reservas de Disfraces
    </h1>
@stop

@section('content')

<div class="container mt-4">

    {{-- Mensajes de éxito o error --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Grid de reservas con cards modernas --}}
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-5">
        @foreach($reservas as $reserva)
            @php
                $fechaLimite = \Carbon\Carbon::parse($reserva->fecha_limite_devolucion);
                $hoy = \Carbon\Carbon::today();

                // Clase para fecha vencida
                $fechaClase = $hoy->gt($fechaLimite) ? 'text-danger fw-bold' : '';

                // Colores del estado
                $estadoColor = match($reserva->estado) {
                    'pendiente' => 'bg-warning text-dark',
                    'confirmado' => 'bg-success text-white',
                    'devuelto' => 'bg-info text-white',
                    'cancelado' => 'bg-danger text-white',
                    default => 'bg-secondary text-white'
                };
            @endphp

            <div class="col">
                <div class="card shadow-lg h-100 border-0 position-relative reserva-card overflow-hidden"
                     style="transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 15px;">

                    {{-- Etiqueta tipo banderita --}}
                    <div class="position-absolute top-0 start-0 px-3 py-1 rounded-bottom-end {{ $estadoColor }}" style="font-weight: bold;">
                        {{ ucfirst($reserva->estado) }}
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title fw-bold text-center">{{ $reserva->disfraz->nombre }}</h5>
                        <p class="card-text mb-1"><strong>Usuario:</strong> {{ $reserva->usuario->nombre }}</p>
                        <p class="card-text mb-1"><strong>Fecha Reserva:</strong> {{ $reserva->fecha_reserva }}</p>
                        <p class="card-text mb-3 {{ $fechaClase }}"><strong>Fecha Límite:</strong> {{ $reserva->fecha_limite_devolucion }}</p>

                        <form method="POST" action="{{ route('Reserva.entregado', $reserva->id) }}" class="d-flex align-items-center">
                            @csrf
                            @method('PATCH')

                            {{-- Checkbox entregado --}}
                            <div class="form-check form-switch me-3">
                                <input class="form-check-input" type="checkbox" name="entregado" value="1" 
                                    id="entregado{{ $reserva->id }}" 
                                    onchange="this.form.submit()" 
                                    {{ $reserva->entregado ? 'checked' : '' }}>
                                <label class="form-check-label" for="entregado{{ $reserva->id }}">Entregado</label>
                            </div>

                            {{-- Select estado --}}
                            <select name="estado" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                                <option value="pendiente"  {{ $reserva->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="confirmado" {{ $reserva->estado == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                                <option value="devuelto"   {{ $reserva->estado == 'devuelto' ? 'selected' : '' }}>Devuelto</option>
                                <option value="cancelado"  {{ $reserva->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Estilos --}}
<style>
.reserva-card:hover {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 16px 30px rgba(0, 0, 0, 0.25);
}
.reserva-card .position-absolute {
    font-size: 0.85rem;
    padding: 0.35rem 0.8rem;
    z-index: 10;
}
.card-body {
    transition: all 0.3s ease;
}
.card-body p, .card-body h5 {
    transition: color 0.3s ease;
}
.reserva-card:hover .card-body p,
.reserva-card:hover .card-body h5 {
    color: #2575fc;
}
</style>
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('usuarios_bloqueados'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Usuarios bloqueados',
        text: {!! json_encode(session('usuarios_bloqueados')) !!},
        confirmButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    });
</script>
@endif
@stop
