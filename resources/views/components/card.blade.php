{{--Este componente contiene el código html del formato de tarjeta, que se repite en varias páginas 
    
    Dado que el componente se usa en varios sitios usando el tag x-card y a veces se quiere añadir un atributo a un x-card concreto (por ejemplo, letra más grande), se pueden añadir usando merge. Aquí se definirán los atributos comunes a todas los tags x-card, pero gracias a merge se podrán también añadir propiedades para un tag en concreto. Por tanto donde antes teníamos una clase en el html, ahora es una propiedad de un array
    --}}

<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}} >
    {{$slot}}
</div>