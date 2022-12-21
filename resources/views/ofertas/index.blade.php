<!-- INDEX: asociado al método index() de OfertasController
Blade permite no tener que usar tantos tags como php nativo, de manera que es más limpio y legible. Las variables van entre doble clave, y los bucles precedidos de una directiva @-->

{{-- indicamos que extiende de la vista principal, que es el documento layout, después ponemos el nombre de la sección que hemos puesto en @yield() --}}
@extends('layout')

@section('content')

{{-- se incluye la sección hero en la carpeta partials --}}
@include('partials._hero')
@include('partials._search')

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

@if(count($ofertas) == 0) 
<p>No se encontraron ofertas</p>
@endif

<!-- recorre el array notas de routes/web.php -->
@foreach($ofertas as $oferta)
{{-- Recibimos el componente oferta-card. Ponemos el nombre del componente precedido de x, después el nombre que hemos puesto en @props precedido de 2 puntos y éste será igual al iterable que hay dentro del foreach --}}
<x-oferta-card :oferta="$oferta" />
@endforeach
</div>

{{-- implementa el selector de páginas.
    Para cambiar de estilo, introducir el comando "php artisan vendor:publish", escoger el núm 5 (PaginationServiceProvider) y se creará una carpeta "vendor" dentro de views con las plantillas disponibles --}}
<div class="mt-6 p-4">
    {{$ofertas->links()}}
</div>
@endsection