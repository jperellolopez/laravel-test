  <!--  en partials se ponen aquellas secciones que sólo se quieren mostrar en algunas páginas -->
  <!-- Hero -->
  <section
  class="relative h-72 bg-laravel flex flex-col justify-center align-center text-center space-y-4 mb-4"
>
  <div
      class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
      style="background-image: url('images/it1.png')"
  ></div>

  <div class="z-10">
      <h1 class="text-6xl font-bold uppercase text-white">
          IT<span class="text-black">Ofertas</span>
      </h1>
      <p class="text-2xl text-gray-200 font-bold my-4">
          Ofertas de empleo y proyectos de IT
      </p>
      @auth
        <div></div>
      @else
           <div>
          <a
              href="/register"
              class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black"
              >Regístrate para encontrar ofertas</a
          >
      </div>
      @endauth

  </div>
</section>