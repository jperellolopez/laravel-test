<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        {{-- script de alpine.js --}}
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#8492a6",
                        },
                    },
                },
            };
        </script>
        <title>ITOFERTAS</title>
    </head>
    <body class="mb-48">
        <nav class="flex justify-between items-center mb-4 mt-4 ml-3">
            <a href="/" class="hover:text-laravel text-lg"
            ><i class="fa-solid fa-house"></i> Índice</a>
            <ul class="flex space-x-6 mr-6 text-lg">

                {{-- lo que está dentro de auth solo se muestra si hay una sesión iniciada --}}
                @auth
                <li>
                    <span class="font-bold uppercase"> Bienvenido, {{auth()->user()->name}}</span>
                </li>
                <li>
                    <a href="/offer/manage" class="hover:text-laravel"
                        ><i class="fa-solid fa-gear"></i>
                        Gestionar ofertas</a
                    >
                </li>
                <li>
                    {{-- form con botón para hacer logout, envía los datos a /logout --}}
                    <form class="inline" method="POST" action="/logout">
                    @csrf
                    <button type="submit">
                        <i class="fa-solid fa-door-closed"></i> Logout
                    </button>
                    </form>
                </li>
                {{-- si la sesión no está iniciada --}}
                @else
                <li>
                    <a href="/register" class="hover:text-laravel"
                        ><i class="fa-solid fa-user-plus"></i> Registro</a
                    >
                </li>
                <li>
                    <a href="/login" class="hover:text-laravel"
                        ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                        Login</a
                    >
                </li>
                @endauth
            </ul>
        </nav>
    {{-- VISTA --}}
    <main>
    @yield('content') 
</main>
<footer
class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center"
>
<p class="ml-2">Copyright &copy; 2022, All Rights reserved - <a href="https://github.com/jperellolopez" target="_blank">GitHub</a></p>

<a
    href="/offer/create"
    class="absolute top-1/3 right-10 bg-black text-white py-2 px-5"
    >Publicar oferta</a
>
</footer>

{{-- componente flash-message --}}
<x-flash-message></x-flash-message>

</body>
</html>