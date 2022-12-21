{{-- Formato del mensaje que sale cuando se publica una nueva oferta. Hay que integrarlo en layout.blade

Se usará Alpine.js para añadir interactividad, ya que por defecto el mensaje queda fijo hasta que se refresca la web. Se debe añadir el script de alpine en el layout. x-data, x-init y x-show son los atributos de alpine que controlan el tiempo que se muestra el mensaje--}}

@if(session()->has('message'))
{{-- show por defecto es true, pasará a false a los 3 segundos y se esconderá --}}
<div x-data="{show:true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
<p>{{session('message')}}</p>
</div>
@endif