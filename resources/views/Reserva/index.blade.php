<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Carrito de Reservas') }}
        </h2>
    </x-slot>

    <div class="cart-container">
        <h2 class="cart-title">🛒 Carrito de Reservas</h2>

        <div class="cart-items">
            @foreach ($carrito as $id => $item)
            <div class="cart-item">
                <img src="{{ asset('storage/'.$item['imagen']) }}" alt="{{ $item['nombre'] }}" class="cart-img">

                <div class="cart-details">
                    <h4>{{ $item['nombre'] }}</h4>
                    <p>Talla: {{ $item['talla'] }}</p>
                    <p class="price">Precio: ${{ number_format($item['precio'], 0) }}</p>
                </div>

                <div class="cart-quantity">
                    <input type="number" name="cantidades[{{ $item['id'] }}]" 
                           value="{{ $item['cantidad'] }}" min="1" form="form-confirmar">
                </div>

                <div class="cart-subtotal">
                    ${{ number_format($item['precio'] * $item['cantidad'], 0) }}
                </div>

                <div class="cart-actions">
                    {{-- FORMULARIO INDEPENDIENTE PARA ELIMINAR --}}
                    <form action="{{ route('carrito.eliminar', $id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm">🗑 Eliminar</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        {{-- FORMULARIO DE CONFIRMACIÓN DE RESERVA --}}
        <form id="form-confirmar" action="{{ route('Reserva.confirmar') }}" method="POST">
            @csrf

            <div class="cart-summary">
                <p><strong>Subtotal:</strong> ${{ number_format($total, 0) }}</p>
                <p><strong>Total:</strong> ${{ number_format($total, 0) }}</p>
            </div>

            <div class="cart-dates">
                <label for="fecha_recogida"><strong>📅 Fecha de Recogida</strong></label>
                <input type="date" id="fecha_recogida" name="fecha_recogida" required>

                <label for="fecha_limite" class="mt-2"><strong>⏳ Fecha Límite de Devolución</strong></label>
                <input type="text" id="fecha_limite" readonly>
            </div>

            <div class="cart-footer">
                <a href="{{ route('disfraz.index') }}" class="btn-back">⬅ Seguir comprando</a>
                <button type="submit" class="btn-confirm">✅ Confirmar Reserva</button>
            </div>
        </form>
    </div>

    <style>
        .cart-container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .cart-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 25px;
        }
        .cart-items {
            border-top: 1px solid #ddd;
        }
        .cart-item {
            display: grid;
            grid-template-columns: 80px 1fr 100px 100px 50px;
            gap: 15px;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .cart-img {
            width: 70px;
            border-radius: 10px;
        }
        .cart-details h4 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
        }
        .cart-details p {
            margin: 2px 0;
            font-size: 14px;
            color: #666;
        }
        .price {
            font-weight: bold;
            color: #333;
        }
        .cart-quantity input {
            width: 60px;
            padding: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
            text-align: center;
        }
        .cart-subtotal {
            font-weight: bold;
            color: #222;
            text-align: right;
        }
        .delete-btn {
            font-size: 18px;
            text-decoration: none;
            color: red;
        }
        .cart-summary {
            margin-top: 20px;
            text-align: right;
            font-size: 16px;
        }
        .cart-dates {
            margin-top: 25px;
        }
        .cart-dates label {
            display: block;
            margin-bottom: 5px;
        }
        .cart-dates input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .cart-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
        }
        .btn-back, .btn-confirm {
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-back {
            background: #f0f0f0;
            color: #333;
        }
        .btn-confirm {
            background: #28a745;
            color: #fff;
        }
        .btn-danger {
            background: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-danger:hover {
            background: #c82333;
        }
    </style>

    <script>
        document.getElementById('fecha_recogida').addEventListener('change', function() {
            let fechaRecogida = new Date(this.value);
            fechaRecogida.setDate(fechaRecogida.getDate() + 7);

            let year = fechaRecogida.getFullYear();
            let month = String(fechaRecogida.getMonth() + 1).padStart(2, '0');
            let day = String(fechaRecogida.getDate()).padStart(2, '0');

            document.getElementById('fecha_limite').value = `${day}/${month}/${year}`;
        });
    </script>
</x-app-layout>
