<?php

use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfertasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ruta por defecto: laravel-test.test
// flujo para añadir CRUD: añadir botón(es) que llevan a la vista, crear la ruta aqui, crear controlador si es necesario, implementar método en controlador, crear la vista

// en esta ruta el primer parámetro es la ruta base, y en el segundo se remite al método index de la clase OfertasController
Route::get('/', [OfertasController::class, 'index']);

// mostrar el formulario para crear una oferta
// middleware() solo hace funcional esa ruta si el usuario está logeado, si no redirecciona a otra
// middleware() se gestiona desde app->middleware->authenticate, donde elegimos a dónde se redirecciona, para ello hay que añadir ->name('nombre') a la ruta, donde 'nombre' es el mismo que está en el método redirectTo de app->middleware->authenticate
Route::get('/offer/create', [OfertasController::class, 'create'])->middleware('auth');

// guarda datos de las ofertas creadas. Recibe los datos del formulario ubicado en views>ofertas>create y ejecuta el método store de OfertasController para hacer la validación
Route:: post('/offer', [OfertasController::class, 'store'])->middleware('auth');

// muestra formulario para editar una oferta en views->ofertas->edit, ejecuta el método edit de OfertasController
Route::get('/offer/{oferta}/edit', [OfertasController::class, 'edit'])->middleware('auth');

// put request para actualizar los datos al editar
Route::put('/offer/{oferta}', [OfertasController::class, 'update'])->middleware('auth');

// borrar oferta
Route::delete('/offer/{oferta}', [OfertasController::class, 'destroy'])->middleware('auth');

//gestionar ofertas
Route::get('/offer/manage', [OfertasController::class, 'manage'])->middleware('auth');

// en esta ruta el primer parámetro es la ruta de una oferta individual y el segundo se remite al método show de la clase OfertasController. El orden de esta ruta tiene que ser el último
Route:: get('/offer/{oferta}', [OfertasController::class, 'show']);


// mostrar formulario de registro
// requiere de un UserController, que se crea con 'php artisan make:controller UserController' 
//middleware('guest') indica que solo queremos que sea accesible por usuarios no registrados (aunque se oculten los botones el usuario podría acceder por la url)
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// crear nuevo usuario con los datos que han venido desde views->usuarios->register
Route::post('/users', [UserController::class, 'store']);

// logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//mostrar formulario de login
// le asignamos un nombre para poder redireccionar si un usuario no está logeado
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// ruta que recibe los datos de views->usuarios->login 
Route::post('/users/authenticate', [UserController::class, 'authenticate']);




/*
//EJEMPLOS

// endpoint que utiliza una response en lugar de una vista. Al mirar los headers en el navegador saldrá con status 200. A partir de la flecha se añaden headers, el primero para mostrar el contenido como texto plano y el segundo para añadir esa información en la GET request.

Route::get('/welcome', function () {
    return response('<h1>Bienvenido</h1>', 200)
    ->header('Content-Type', 'text/plain')
    ->header('nombre', 'contenido');
});

// endpoint que utiliza una variable en la ruta. La respuesta muestra el valor de la variable. Con where podemos aplicar restricciones, por ejemplo para que la variable sólo admita números con una expresión regular. dd() se usa para debugear, ya que vuelca la variable indicada en el navegador y termina la ejecución

Route::get('/posts/{id}', function($id) {
    //dd($id);
    return response('Post ' . $id);
})->where('id', '[0-9]+');

// poniendo el parámetro Request en la función, se indica que estamos accediendo a una HTTP Request. En la url hemos pasado dos parámetros (http://laravel-test.test/search?name=Jordi&city=Palma), que son accesibles desde $request->variable
Route::get('/search', function(Request $request) {
    return $request->name . " " . $request->city;
});
*/




