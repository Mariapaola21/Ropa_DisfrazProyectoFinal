<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disfraces - Alquila tu disfraz perfecto</title>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        /* Estilos personalizados existentes */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .header {
            background-color: #f8f9fa;
        }
        .header-logo {
            color: #4B0082;
        }
        .hero-section {
            background-color: #311145;
            background-image: url('https://thumbs.dreamstime.com/z/autorretrato-de-tres-locas-despreocupadas-teniendo-buen-humor-bellas-damas-en-gorras-azul-violeta-falso-peinado-anaranjado-159828869.jpg');
            background-size: cover;
            background-blend-mode: multiply;
            background-position: center;
        }
        .hero-image {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }
        .hero-content {
            position: relative;
            z-index: 2;
            width: 50%;
            color: #fff;
        }
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.1;
        }
        .hero-subtitle {
            font-size: 1.25rem;
            margin-top: 1rem;
        }
        .hero-button {
            background-image: linear-gradient(to right, #A0522D, #B22222);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hero-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }
        .header {
    position: fixed;   /* Fija el header en la pantalla */
    top: 0;            /* Lo ubica en la parte superior */
    left: 0;
    width: 100%;       /* Que ocupe todo el ancho */
    background-color: #fff; /* Color de fondo */
    padding: 10px 20px;
    z-index: 1000;     /* Que se superponga al contenido */
    border-bottom: 1px solid #ddd; /* Línea separadora */
}

/* Para que el contenido no se esconda debajo del header */
main {
    margin-top: 80px; /* Igual o mayor a la altura del header */
}
        .card-placeholder {
            height: 250px;
            background-color: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: #a0aec0;
            position: relative;
        }
        .card-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .btn-add-to-cart {
            background-color: #2D3748;
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-add-to-cart:hover {
            background-color: #4A5568;
            transform: translateY(-1px);
        }
        .input-group {
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
        }
        .input-qty {
            width: 60px;
            text-align: center;
        }
        .badge {
            background-color: #EBF4FF;
            color: #4299E1;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.875rem;
        }
        .promo-banner {
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .promo-banner-orange {
            background-color: #F97316;
        }
        .promo-banner-gray {
            background-color: #6B7280;
        }
        .promo-banner-content {
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
        }

        /* Estilos para el carrusel de tarjetas de disfraces */
        .swiper-container {
            width: 100%;
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .swiper-slide {
            background-position: center;
            background-size: cover;
            width: 290px;
            height: 550px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .swiper-slide .content {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);
            color: white;
            text-align: center;
        }

        /* Nuevos estilos para la sección de métodos de pago */
        .payment-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .payment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }
        .payment-card img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body class="font-sans">

    <header class="header shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold header-logo flex items-center">
                <svg class="w-8 h-8 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 20a10 10 0 110-20 10 10 0 010 20zm-1.895-7.399l-2.188-2.188a1.5 1.5 0 012.121-2.121l.394.394L10 9.879l2.568-2.568a1.5 1.5 0 012.121 2.121l-2.188 2.188a1.5 1.5 0 01-2.121 0z"></path>
                </svg>
                Disfraces
            </a>
            <div class="hidden md:flex items-center space-x-6 text-gray-700 font-medium">
                <a href="{{route('disfraz.index')}}" class="hover:text-purple-600">Inicio</a>
                <a href="#" class="hover:text-purple-600">Catálogo</a>
                <a href="#" class="hover:text-purple-600">Nosotros</a>
                <a href="#" class="hover:text-purple-600">Contacto</a>
               <div class="flex items-center space-x-4">
    {{-- Carrito --}}
    <a href="{{ route('Reserva.index') }}" class="relative flex items-center">
        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 3h2l.4 2M7 13h10l4-8H5.4
                     M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17
                     m0 0a2 2 0 100 4 2 2 0 000-4
                     zm-8 2a2 2 11-4 0 2 2 0 014 0z" />
        </svg>
        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
            {{ $cantidadCarrito }}
        </span>
    </a>

    {{-- Grupo --}}
    <a href="{{route('Reserva.historial')}}" class="flex items-center">
        <svg class="w-6 h-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 
                     1.34 3 3 3zm-8 0c1.66 0 
                     2.99-1.34 2.99-3S9.66 5 8 5 
                     5 6.34 5 8s1.34 3 3 3zm0 
                     2c-2.33 0-7 1.17-7 3.5V19h14v-2.5
                     C18 14.17 13.33 13 11 13zm8 
                     0c-.29 0-.62.02-.97.05 1.16.84 
                     1.97 1.97 1.97 3.45V19h6v-2.5
                     c0-2.33-4.67-3.5-7-3.5z"/>
        </svg>
    </a>

    {{-- Usuario --}}
    <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="flex items-center">
        <svg class="w-6 h-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <circle cx="12" cy="7" r="4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M5.5 21a7.5 7.5 0 0113 0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
</div>


</div>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-section relative h-screen flex items-center px-20">
            <div class="hero-content">
                <h1 class="hero-title text-white">ALQUILA TU DISFRAZ</h1>
                <p class="hero-subtitle text-white mt-4">Tenemos el disfraz perfecto para tu próximo evento</p>
                <a href="#" class="hero-button text-white px-8 py-3 rounded-full inline-block mt-8 font-bold text-lg">Ver catálogo</a>
            </div>
        </section>

        <section class="py-16">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-12">En Tendencia </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">



                    <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="card-placeholder">
                            <img src="https://tse3.mm.bing.net/th/id/OIP.ZTNgyTULnNfwG6BcqcQamwAAAA?r=0&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Disfraz de Mago">
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-semibold">Mago Clásico</h3>
                                <span class="badge">Disponible</span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Desde $50.000 por evento</p>
                            <div class="flex space-x-2 items-center mb-6">
                                <div class="input-group flex-grow">
                                    <select class="w-full p-2 rounded-lg">
                                        <option>Talla</option>
                                        <option>S</option>
                                        <option>M</option>
                                        <option>L</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <input type="number" value="1" min="1" class="input-qty p-2 rounded-lg">
                                </div>
                            </div>
                            <button class="btn-add-to-cart w-full">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Agregar a la reserva
                            </button>
                        </div>
                    </div>



                    <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="card-placeholder">
                            <img src="https://th.bing.com/th/id/R.6e2b0f2029363aa4b9469633358fff37?rik=F7CnuuvtNeoeYQ&pid=ImgRaw&r=0" alt="Disfraz de Pirata">
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-semibold">Pirata Clásico</h3>
                                <span class="badge">Disponible</span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Desde $50.000 por evento</p>
                            <div class="flex space-x-2 items-center mb-6">
                                <div class="input-group flex-grow">
                                    <select class="w-full p-2 rounded-lg">
                                        <option>Talla</option>
                                        <option>S</option>
                                        <option>M</option>
                                        <option>L</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <input type="number" value="1" min="1" class="input-qty p-2 rounded-lg">
                                </div>
                            </div>
                            <button class="btn-add-to-cart w-full">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Agregar a la reserva
                            </button>
                        </div>
                    </div>
                    <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="card-placeholder">
                            <img src="https://m.media-amazon.com/images/I/41l4L7QXiML._SL500_.jpg" alt="Disfraz de Princesa">
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-semibold">Princesa Clásico</h3>
                                <span class="badge">Disponible</span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Desde $50.000 por evento</p>
                            <div class="flex space-x-2 items-center mb-6">
                                <div class="input-group flex-grow">
                                    <select class="w-full p-2 rounded-lg">
                                        <option>Talla</option>
                                        <option>S</option>
                                        <option>M</option>
                                        <option>L</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <input type="number" value="1" min="1" class="input-qty p-2 rounded-lg">
                                </div>
                            </div>
                            <button class="btn-add-to-cart w-full">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Agregar a la reserva
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="py-16 promotions-section">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="promo-banner promo-banner-orange md:flex">
                        <div class="p-4 md:w-1/2">
                            <img src="https://tse3.mm.bing.net/th/id/OIP.tfn2lOcIuJeQe4gnLj8SzwHaEJ?r=0&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Logo de promoción" class="mx-auto md:mx-0 rounded-lg">
                        </div>
                        <div class="promo-banner-content md:w-1/2 text-center md:text-left">
                            <h3 class="text-xl md:text-2xl font-bold leading-tight mb-2">PROMOCIÓN DE TEMPORADA</h3>
                            <p class="mb-4">Disfraces seleccionados hasta <span class="font-bold">35% OFF</span></p>
                            <a href="#" class="text-white text-sm font-semibold hover:underline">Ver ofertas ></a>
                        </div>
                    </div>
                    
                    <div class="promo-banner promo-banner-gray md:flex">
                       <div class="p-4 md:w-1/2">
                            <img src="https://tse2.mm.bing.net/th/id/OIP.QmPADUK6aJu8X6eSBvp1XwHaEJ?r=0&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Decoraciones para fiesta" class="mx-auto md:mx-0 rounded-lg">
                        </div>
                        <div class="promo-banner-content md:w-1/2 text-center md:text-left">
                            <h3 class="text-xl md:text-2xl font-bold leading-tight mb-2">DECORA TU FIESTA</h3>
                            <p class="mb-4">Haz que tu evento sea inolvidable con nuestras decoraciones temáticas.</p>
                            <a href="#" class="text-white text-sm font-semibold hover:underline">Ver más ></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

       
        
     <section>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach($disfraces as $disfraz)
                <div class="swiper-slide">
                    <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden">
                        <form action="{{ route('carrito.agregar') }}" method="POST">
                            @csrf
                            <input type="hidden" name="disfraz_id" value="{{ $disfraz->id }}">
                            
                           <div class="card-placeholder">
    <img src="{{ $disfraz->imagen ? asset('storage/' . $disfraz->imagen) : 'https://via.placeholder.com/400x300' }}" 
         alt="Imagen del Disfraz" 
         class="w-full h-48 object-cover">
</div>

                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-semibold">{{ $disfraz->nombre }}</h3>
                                    <span class="badge">Disponible</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">
                                    {{ $disfraz->descripcion }}
                                </p>
                                <p class="text-lg font-semibold mt-2">Precio: ${{ number_format($disfraz->precio, 0, ',', '.') }}</p>
                                
                                <div class="flex space-x-2 items-center mb-6">
                                    <div class="input-group flex-grow">
                                        <select name="talla" class="w-full p-2 rounded-lg">
                                            <option>Talla</option>
                                        
                                        <option value="{{ $disfraz->talla }}">{{ $disfraz->talla }}</option>
                                            
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <input type="number" name="cantidad" value="1" min="1" class="input-qty p-2 rounded-lg">
                                    </div>
                                </div>
                                
                              <form action="{{ route('Reserva.confirmar') }}" method="POST">
                                 @csrf
                                    <input type="hidden" name="disfraz_id" value="{{ $disfraz->id }}">
    
                                         <button type="submit" class="btn-add-to-cart w-full flex items-center justify-center">
                                         <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" 
                                          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                         <path stroke-linecap="round" stroke-linejoin="round" 
                                        stroke-width="2" 
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4
                                         M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17
                                         m0 0a2 2 0 100 4 2 2 0 000-4
                                        zm-8 2a2 2 11-4 0 2 2 0 014 0z">
                                        </path>
                                         </svg>
                                        Agregar a la reserva
                                        </button>
                                    </form>

                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

 <section class="py-16 bg-gray-100">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-12">Métodos de Pago</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6 justify-items-center">
                    <div class="payment-card bg-white p-4 rounded-lg shadow-lg flex items-center justify-center w-full">
                        <img src="https://logodownload.org/wp-content/uploads/2016/10/visa-logo.png" alt="Logo Visa" class="h-12 object-contain">
                    </div>
                    
                    <div class="payment-card bg-white p-4 rounded-lg shadow-lg flex items-center justify-center w-full">
                        <img src="https://brandemia.org/sites/default/files/sites/default/files/mastercard_pentagram_press-4.jpg" alt="Logo Mastercard" class="h-12 object-contain">
                    </div>
                    
                    <div class="payment-card bg-white p-4 rounded-lg shadow-lg flex items-center justify-center w-full">
                        <img src="https://tse3.mm.bing.net/th/id/OIP.IA_1lpSH6tyfzQU-8KqhAAHaCm?r=0&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Logo American Express" class="h-12 object-contain">
                    </div>
                    
                    <div class="payment-card bg-white p-4 rounded-lg shadow-lg flex items-center justify-center w-full">
                        <img src="https://tse2.mm.bing.net/th/id/OIP.iUD20gtafeILdJXudWyinAHaEJ?r=0&w=500&h=280&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Logo Diners Club" class="h-12 object-contain">
                    </div>

                    <div class="payment-card bg-white p-4 rounded-lg shadow-lg flex items-center justify-center w-full">
                        <img src="https://tse1.mm.bing.net/th/id/OIP.3lPbh6dPUClu40P7IdLBKwAAAA?r=0&w=474&h=243&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Logo PSE" class="h-12 object-contain">
                    </div>

                    <div class="payment-card bg-white p-4 rounded-lg shadow-lg flex items-center justify-center w-full">
                        <img src="https://logodownload.org/wp-content/uploads/2014/10/paypal-logo.png" alt="Logo PayPal" class="h-12 object-contain">
                    </div>
                </div>
            </div>
        </section>



        <section class="py-16 bg-white">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-12">¿Por qué elegirnos?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-6">
                        <div class="flex justify-center mb-4">
                            <svg class="w-12 h-12 text-purple-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm-1.293 8.293a1 1 0 011.414 0l.707.707 3-3a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-1.5-1.5a1 1 0 011.414-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Calidad Garantizada</h3>
                        <p class="text-gray-600">Todos nuestros disfraces están hechos con materiales de alta calidad.</p>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-center mb-4">
                            <svg class="w-12 h-12 text-purple-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3-4a1 1 0 011-1h8a1 1 0 110 2H7a1 1 0 01-1-1zm0 8a1 1 0 011-1h8a1 1 0 110 2H7a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Entrega Rápida</h3>
                        <p class="text-gray-600">Recibe tu pedido en tiempo récord para tu evento.</p>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-center mb-4">
                            <svg class="w-12 h-12 text-purple-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM6 10a4 4 0 118 0 4 4 0 01-8 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Limpieza Garantizada</h3>
                        <p class="text-gray-600">Cada disfraz es higienizado y revisado antes de ser entregado.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // Inicialización del carrusel Swiper
        const swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            loop: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 50,
                stretch: -30,
                depth: 200,
                modifier: 1,
                slideShadows: true
            },
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            }
        });
    </script>

</body>
</html>
