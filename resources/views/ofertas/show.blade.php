{{-- SHOW: asociado al método show() de OfertasController --}}

@extends('layout')

@section('content')
@include('partials._search')

<a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
</a>
<div class="mx-4">
    {{-- se ha usado el tag del componente x-card, añadiéndole varios atributos que sólo serán visibles en esta página --}}
    <x-card class="p-10 bg-zinc-100">
        <div class="flex flex-col items-center justify-center text-center">

            <h3 class="text-2xl mb-2">{{$oferta['title']}}</h3>
            <div class="text-xl font-bold mb-4">{{$oferta['company']}}</div>
            {{--recibe los tags desde la bd, los guarda en :tagsCsv y lo envia al componente oferta-tags --}}
           <x-oferta-tags :tagsCsv="$oferta['tags']"/>
            <div class="text-lg my-4">
                <i class="fa-solid fa-location-dot"></i> {{$oferta['location']}}
            </div>
            <div class="border border-gray-200 w-full mb-6"></div>
            <div>
                <h3 class="text-3xl font-bold mb-4">
                    Descripción de la oferta:
                </h3>
                <div class="text-lg space-y-6">
                    {{$oferta['description']}}

                    <a href="mailto:{{$oferta['email']}}"
                        class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                            class="fa-solid fa-envelope"></i>
                        Email de contacto</a>

                    <a href="{{$oferta['website']}}" target="_blank"
                        class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i
                            class="fa-solid fa-globe"></i> Página Web</a>
                </div>
            </div>
        </div>
    </x-card>

    {{-- botón para editar oferta 
    <x-card class="mt-4 p-2 flex space-x-6">
        <a href="/offer/{{$oferta['id']}}/edit">
        <i class="fa-solid fa-pencil"></i> Editar
        </a>

        {{-- botón para borrar una oferta 
        <form method="POST" action="/offer/{{$oferta['id']}}">
        @csrf
        @method('delete')
        <button class="text-red-500"> <i class="fa-solid fa-trash"></i> Borrar</button>
        </form>

    </x-card>
    --}}
</div>

@endsection