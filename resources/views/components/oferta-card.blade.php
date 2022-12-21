{{-- 
    Se usan los componentes para cosas que se repiten mucho en la aplicación, como por ejemplo estilos o iterables.
    Se ha guardado cada nota/card con una oferta como un componente, en el cual se tienen que definir sus propiedades con @props.
    También se ha envuelto todo en el componente x-card, que define el formato de tarjeta --}}

@props(['oferta'])

<x-card>
    <div class="flex">

        <div>
            <h3 class="text-2xl">
                <a href="/offer/{{$oferta['id']}}">{{$oferta['title']}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$oferta['company']}}</div>
            <x-oferta-tags :tagsCsv="$oferta['tags']"/>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$oferta['location']}}
            </div>
        </div>
    </div>
</x-card>