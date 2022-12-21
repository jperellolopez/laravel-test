@extends('layout')

@section('content')
<x-card class="p-10 rounded max-w-lg mx-auto mt-24">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Publicar una oferta
        </h2>
        <p class="mb-4">Encuentra trabajadores interesados en tu proyecto</p>
    </header>

    {{-- El formulario envia los datos a la route /offer --}}
    <form method="POST" action="/offer">
        {{-- directiva csrf de seguridad --}}
        @csrf
        {{-- atributo value=old() sirve para que al introducir datos incorrectos estos se queden puestos en el formulario --}}
        <div class="mb-6">
            <label for="company" class="inline-block text-lg mb-2">Nombre de la compañía</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="company" value="{{old('company')}}" />

            {{-- directiva que muestra un mensaje de error si no se valida un campo --}}
            @error('company')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="title" class="inline-block text-lg mb-2">Puesto ofrecido</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                placeholder="Ej: Senior Laravel Developer" value="{{old('title')}}" />

                @error('title')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
        </div>

        <div class="mb-6">
            <label for="location" class="inline-block text-lg mb-2">Localización del puesto</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
                placeholder="Ej: Remoto, Madrid, etc" value="{{old('location')}}" />

                @error('location')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
        </div>

        <div class="mb-6">
            <label for="email" class="inline-block text-lg mb-2">Email de contacto</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{old('email')}}" />

            @error('email')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="website" class="inline-block text-lg mb-2">
                Dirección URL
            </label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website" value="{{old('website')}}" />

            @error('website')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="tags" class="inline-block text-lg mb-2">
                Tags (Separados por comas)
            </label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
                placeholder="Ej: Laravel, Backend, Postgres, etc" value="{{old('tags')}}" />

                @error('tags')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
        </div>

        <div class="mb-6">
            <label for="description" class="inline-block text-lg mb-2">
                Descripción del puesto de trabajo ofrecido
            </label>
            <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
                placeholder="Tareas, requisitos, salario, etc">
                {{old('description')}}
            </textarea>

                @error('description')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
        </div>

        <div class="mb-6">
            <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                Publicar oferta
            </button>

            <a href="/" class="text-black ml-4"> Atrás </a>
        </div>
    </form>
</x-card>
@endsection