<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://kit.fontawesome.com/5ced8a2d57.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<body>
    <header>
        <nav class="navbar">
            <h1 class="navbar__title">&#60;Metalurgica Y Herreria Pravata/&#62</h1>

            <ul class="navbar__menu">

                <li><a href="{{ route('pagina_principal') }}">Inicio</a></li>
                <li><a href="{{ route('contact.show') }}">Contactanos</a></li>
                <li><a href="{{ route('nosotros-info') }}">Sobre Nosotros</a></li>
                <li><a href="https://www.google.com.ar/maps/place/Metal%C3%BArgico+%26+Herrer%C3%ADa+Artistica+Cacho/@-33.0207869,-68.8091093,620m/data=!3m1!1e3!4m8!3m7!1s0x967e738a8fff0c29:0x5f990846a5b967dc!8m2!3d-33.0207869!4d-68.8091093!9m1!1b1!16s%2Fg%2F11ny2sscj0?entry=ttu">Opiniones</a></li>
                @if (Auth::check())
                    <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li><a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar
                            Sesión</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else

                @endif
            </ul>
        </nav>
    </header>

    </h1>

    <main>
        @yield('main')
    </main>

    <section class="catalogo">
        @yield('section')
    </section>

    <section>
        @yield('form')
    </section>

    <footer class="footer">
        <p><span>&copy;</span> Metalurgica Y Herreria Artistica/ - Todos los derechos reservados - Vigencia desde 2023
            hasta la fecha</p>
    </footer>
</body>

</html>
