<x-guest-layout>
    <style>
        body {
            background: linear-gradient(to right, #6366f1, #8b5cf6, #ec4899);
            font-family: 'Segoe UI', sans-serif;
        }

        .register-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            padding: 2rem;
            width: 100%;
            max-width: 600px; /* Aumentado para que los campos quepan */
            margin: 3rem auto;
        }

        .register-title {
            font-weight: 700;
            color: #4c1d95;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        /* Nuevo estilo para agrupar campos */
        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }
        /* Fin de los nuevos estilos */

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.3rem;
            color: #333;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.6rem;
            border: 1px solid #ccc;
            font-size: 1rem;
            transition: 0.3s;
        }

        .form-input:focus {
            border-color: #8b5cf6;
            outline: none;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.25);
        }

        .btn-register {
            background: linear-gradient(90deg, #6366f1, #ec4899);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 0.75rem;
            border-radius: 0.6rem;
            width: 100%;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-register:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }

        .text-link {
            color: #6366f1;
            text-decoration: none;
            font-weight: 600;
        }

        .text-link:hover {
            text-decoration: underline;
        }

        .text-muted {
            font-size: 0.9rem;
            color: #666;
        }
    </style>

    <div class="register-card">
        <h3 class="register-title">Crea tu cuenta</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input id="nombre" type="text" name="nombre" class="form-input" :value="old('nombre')" required autofocus autocomplete="name">
                    <x-input-error :messages="$errors->get('nombre')" class="text-danger text-sm mt-1" />
                </div>
                
                <div class="form-group">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input id="apellido" type="text" name="apellido" class="form-input" :value="old('apellido')" required autocomplete="family-name">
                    <x-input-error :messages="$errors->get('apellido')" class="text-danger text-sm mt-1" />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="documento" class="form-label">Documento</label>
                    <input id="documento" type="text" name="documento" class="form-input" :value="old('documento')" required>
                    <x-input-error :messages="$errors->get('documento')" class="text-danger text-sm mt-1" />
                </div>
                
                <div class="form-group">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input id="telefono" type="tel" name="telefono" class="form-input" :value="old('telefono')" required>
                    <x-input-error :messages="$errors->get('telefono')" class="text-danger text-sm mt-1" />
                </div>
            </div>

            <div class="form-group">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input id="correo" type="email" name="correo" class="form-input" :value="old('correo')" required autocomplete="username">
                <x-input-error :messages="$errors->get('correo')" class="text-danger text-sm mt-1" />
            </div>
            
            <div class="form-group">
                <label for="direccion" class="form-label">Dirección</label>
                <input id="direccion" type="text" name="direccion" class="form-input" :value="old('direccion')" required>
                <x-input-error :messages="$errors->get('direccion')" class="text-danger text-sm mt-1" />
            </div>
            
            <input type="hidden" name="tipo_usuario" value="cliente">

            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" type="password" name="password" class="form-input" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="text-danger text-sm mt-1" />
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-input" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger text-sm mt-1" />
            </div>

            <div class="form-group" style="text-align:center; margin-top:1.5rem;">
                <p class="text-muted">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login') }}" class="text-link">Inicia sesión aquí</a>
                </p>
                <button type="submit" class="btn-register mt-2">Registrarme</button>
            </div>
        </form>
    </div>
</x-guest-layout>