@extends('adminlte::page')

@section('title', 'Historial de Reservas')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-calendar-check"></i> Historial de Reservas</h1>
@stop

@section('content')
    
<div class="row">
    @php $totalPago = 0; @endphp
    @foreach($reservas as $reserva)
        @php 
            $subtotal = ($reserva->disfraz->precio ?? 0) * $reserva->cantidad;
            $totalPago += $subtotal;
        @endphp
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card reserva-card shadow-sm">
                <div class="card-img-top text-center p-3 bg-light">
                     <!-- Imagen -->
                <div class="card-img-top text-center p-3 bg-light">
                    @if($reserva->disfraz && $reserva->disfraz->imagen)
                        <img src="{{ asset('storage/' . $reserva->disfraz->imagen) }}" 
                             class="miniatura" alt="{{ $reserva->disfraz->nombre }}">
                    @else
                        <span class="text-muted">Sin imagen</span>
                    @endif
                </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-truncate">{{ $reserva->disfraz->nombre ?? 'Disfraz desconocido' }}</h5>
                    
                    <p class="card-text"><i class="fas fa-user me-2"></i> <strong>Usuario:</strong> {{ $reserva->usuario->nombre ?? 'Desconocido' }}</p>
                    <p class="card-text"><i class="fas fa-calendar-alt me-2"></i> <strong>Reserva:</strong> {{ $reserva->fecha_reserva->format('d/m/Y') }}</p>
                    <p class="card-text"><i class="fas fa-hourglass-half me-2"></i> <strong>Límite:</strong> {{ $reserva->fecha_limite_devolucion->format('d/m/Y') }}</p>
                    <p class="card-text"><i class="fas fa-boxes me-2"></i> <strong>Cantidad:</strong> {{ $reserva->cantidad }}</p>
                    <p class="card-text"><i class="fas fa-dollar-sign me-2"></i> <strong>Subtotal:</strong> ${{ number_format($subtotal,2) }}</p>
                    
                    <div class="mt-2">
                        <span class="badge estado-{{ $reserva->estado }}">{{ ucfirst($reserva->estado) }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="text-end mt-4">
    <h4>Total pagado: <span class="text-success">${{ number_format($totalPago,2) }}</span></h4>
</div>
@stop

@section('css')
<style>
/* Card hover y animación */
.reserva-card {
    border-radius: 15px;
    transition: transform 0.3s, box-shadow 0.3s;
    border: 1px solid #e0e0e0;
}
.reserva-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 28px rgba(0,0,0,0.18), 0 10px 10px rgba(0,0,0,0.12);
}

/* Miniatura del disfraz */
.miniatura {
    width: 130px;
    height: 130px;
    object-fit: cover;
    border-radius: 15px;
    transition: transform 0.3s, box-shadow 0.3s;
}
.miniatura:hover {
    transform: scale(1.35);
    box-shadow: 0 10px 20px rgba(0,0,0,0.25);
}

/* Badges de estado */
.badge {
    padding: 0.5em 0.8em;
    border-radius: 15px;
    font-size: 0.85em;
    color: #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}
.estado-pendiente { background-color: #f0ad4e; }
.estado-entregado { background-color: #5cb85c; }
.estado-devuelto { background-color: #5bc0de; }
.estado-cancelado { background-color: #d9534f; }

/* Tipografía y textos */
h1.text-primary { font-weight: 700; }
.card-body p { margin-bottom: 0.4rem; font-size: 0.95rem; }
.card-title { font-weight: 600; font-size: 1.1rem; }

/* Iconos */
.me-2 { margin-right: 0.5rem; }

</style>
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('bloqueado'))
<script>
    Swal.fire({
        icon: 'error',
        title: '¡Acción no permitida!',
        text: {!! json_encode(session('bloqueado')) !!},
        confirmButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    });
</script>
@endif

@if(session('reserva_vencida'))
<script>
    Swal.fire({
        icon: 'warning',
        title: 'Reserva vencida',
        text: {!! json_encode(session('reserva_vencida')) !!},
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
    });
</script>
@endif

<script>
console.log("Historial de reservas con diseño más bonito cargado.");
</script>
@stop
