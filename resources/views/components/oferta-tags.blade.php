{{-- Recibe un array de tags desde la BD que llega desde la página donde se usa este componente (nota.blade o oferta-card.blade) --}}
@props(['tagsCsv'])

{{-- para obtener los tags individualmente se usa explode--}}
@php
    
$tags = explode(',', $tagsCsv);

@endphp

{{-- se itera sobre los tags. En el href se pone el tag para poder hacer click y filtrar por ese tag --}}
<ul class="flex">
    @foreach($tags as $tag)
    <li class="bg-black text-white rounded-xl px-3 py-1 mr-2">
        <a href="/?tag={{$tag}}">{{$tag}}</a>
    </li>
    @endforeach
</ul>