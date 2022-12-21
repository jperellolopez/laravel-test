{{-- Recibe la variable ofertas desde el método manage() de ofertasController --}}
@extends('layout')

@section('content')

<x-card class="p-10">
    <header>
        <h1 class="text-3xl text-center font-bold my-6 uppercase">
            Gestión de mis ofertas
        </h1>
    </header>

    <table class="w-full table-auto rounded-sm">
        <tbody>
            
            @if(count($ofertas) == 0) 
            <tr class="border-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <p class="text-center">No se han encontrado ofertas</p>
                </td>
            </tr>
            @endif

            @foreach($ofertas as $oferta)

            <tr class="border-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <a href="/offer/{{$oferta['id']}}">
                        {{$oferta['title']}}
                    </a>
                </td>
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <a href="/offer/{{$oferta['id']}}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i
                            class="fa-solid fa-pen-to-square"></i>
                        Editar</a>
                </td>
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <form method="POST" action="/offer/{{$oferta['id']}}">
                        @csrf
                        @method('delete')
                        <button class="text-red-600">
                            <i class="fa-solid fa-trash-can"></i>
                            Borrar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
    
        </tbody>
    </table>
</x-card>

@endsection