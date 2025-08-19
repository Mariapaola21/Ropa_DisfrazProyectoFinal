<x-guest-layout>
    <style>
        body {
            background: linear-gradient(to right, #6366f1, #8b5cf6, #ec4899);
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            margin: 3rem auto;
        }

        .login-title {
            font-weight: 700;
            color: #4c1d95;
            text-align: center;
            margin-bottom: 1.5rem;
        }

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

        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-check input {
            accent-color: #6366f1; /* cambia color del check */
        }

        .btn-login {
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

        .btn-login:hover {
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

    <div class="login-card">
        <h3 class="login-title">Inicia sesión en tu cuenta</h3>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input id="correo" type="email" name="correo"
                       class="form-input"
                       :value="old('correo')" required autofocus autocomplete="username">
                <x-input-error :messages="$errors->get('correo')" class="text-danger text-sm mt-1" />
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" type="password" name="password"
                       class="form-input"
                       required autocomplete="current-password">
                <x-input-error :messages="$errors->get('password')" class="text-danger text-sm mt-1" />
            </div>

            <div class="form-group" style="display:flex; justify-content:space-between; align-items:center;">
                <label class="form-check">
                    <input type="checkbox" id="remember_me" name="remember">
                    <span>Recuérdame</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-link">¿Olvidaste tu contraseña?</a>
                @endif
            </div>

            <button type="submit" class="btn-login">Iniciar sesión</button>
        </form>

        <p class="mt-4 text-center text-muted">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-link">Regístrate aquí</a>
        </p>
    </div>
</x-guest-layout>