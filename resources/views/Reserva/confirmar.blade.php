<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Factura de Reserva') }}
        </h2>
    </x-slot>

    <div class="invoice-container">
        <div class="invoice-card">
            
            {{-- Encabezado --}}
            <div class="invoice-header">
                <div>
                    <h2 class="company-name">🎭 Disfraces S.A.</h2>
                    <p class="subtitle">Comprobante de Reserva</p>
                </div>
                <div class="invoice-meta">
                    <p><strong>Fecha de emisión:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                </div>
            </div>

            {{-- Datos del cliente y fechas --}}
           <div class="invoice-info">
    <div>
        <h4>Cliente</h4>
        <p>
            {{ Auth::user()->nombre ?? 'Usuario' }}
            {{ Auth::user()->apellido ?? '' }} <br>
             {{ Auth::user()->documento ?? '' }}
        </p>
    </div>
    <div>
        <h4>Detalles de Reserva</h4>
        <p>
            📅 Recogida: <strong>{{ \Carbon\Carbon::parse($fechaRecogida)->format('d/m/Y') }}</strong><br>
            ⏳ Devolución: <strong>{{ \Carbon\Carbon::parse($fechaLimite)->format('d/m/Y') }}</strong>
        </p>
    </div>
</div>

            {{-- Tabla --}}
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Disfraz</th>
                        <th>Talla</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carrito as $item)
                        <tr>
                            <td>{{ $item['nombre'] }}</td>
                            <td>{{ $item['talla'] }}</td>
                            <td>{{ $item['cantidad'] }}</td>
                            <td>${{ number_format($item['precio'], 2) }}</td>
                            <td>${{ number_format($item['precio'] * $item['cantidad'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Total --}}
            <div class="invoice-total">
                <h3>Total: <span>${{ number_format($total ?? 0, 2) }}</span></h3>
            </div>

            {{-- Botones --}}
            <form action="{{ route('Reserva.store') }}" method="POST" class="invoice-actions">
                @csrf
                <input type="hidden" name="fecha_recogida" value="{{ $fechaRecogida }}">
                <button type="submit" class="btn-confirm">✅ Confirmar y Guardar Reserva</button>
                <a href="{{ route('Reserva.index') }}" class="btn-back">⬅ Volver</a>
            </form>
        </div>
    </div>

    <style>
        .invoice-container {
            display: flex;
            justify-content: center;
            margin: 40px auto;
            padding: 20px;
        }
        .invoice-card {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            max-width: 900px;
            width: 100%;
            font-family: Arial, sans-serif;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .company-name {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .subtitle {
            color: #777;
            margin: 5px 0 0;
        }
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .invoice-info h4 {
            margin: 0 0 5px;
            color: #444;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .invoice-table th {
            background: #f5f5f5;
            color: #333;
        }
        .invoice-total {
            text-align: right;
            margin-top: 10px;
        }
        .invoice-total h3 {
            font-size: 20px;
            color: #222;
        }
        .invoice-total span {
            color: #28a745;
            font-weight: bold;
        }
        .invoice-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
            gap: 10px;
        }
        .btn-confirm {
            background: #28a745;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
        }
        .btn-confirm:hover {
            background: #218838;
        }
        .btn-back {
            background: #f0f0f0;
            color: #333;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
        }
        .btn-back:hover {
            background: #ddd;
        }
    </style>

    <script>
        // Efecto simple de animación en la carga
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelector(".invoice-card").style.opacity = 0;
            setTimeout(() => {
                document.querySelector(".invoice-card").style.transition = "opacity 0.6s ease-in-out";
                document.querySelector(".invoice-card").style.opacity = 1;
            }, 200);
        });
    </script>
</x-app-layout>
