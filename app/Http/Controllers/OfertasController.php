<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rule as ValidationRule;

// crear controlador con artisan: php artisan make:controller nombre 
// se crean en app->Http->Controllers

class OfertasController extends Controller
{/* 
     Mostrar todas las ofertas, devuelve la vista de ofertas>index

     Los métodos latest()->filter()->get() servirán para capturar el último elemento tag o search (tag=elemento o search=elemento en la barra de tareas) y poder enviarlo al método scopeFilter() del modelo
    
    Para paginar, sustituir el get() final por paginate(elementosPorPag). Esto muestra el número de resultados por página, pero no un selector de páginas para desplazarse entre ellas, que se tiene que crear en views->ofertas->index
    */
    public function index()
    {
        return view('ofertas.index', [
            'ofertas' => Oferta::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }


    // Mostrar una oferta, devuelve la vista de ofertas>show
    public function show(Oferta $oferta)
    {
        return view('ofertas.show', [
            'oferta' => $oferta
        ]);
    }

    // mostrar formulario para crear una oferta
    public function create()
    {
        return view('ofertas.create');
    }

    //almacenar los datos del formulario
    public function store(Request $request)
    {

        // validar los campos del form de views>ofertas>create
        // con el método validate, se ponen dentro los campos que van a ser requeridos y/o unicos
        // si un campo no se valida, se usa la directiva @error en la vista para mostrar el error
        // todos los campos que se envian han de estar en el array $fillable del modelo Oferta
        $formFields = $request->validate([
            // compañía es requerida y además única (1r param nombre tabla, 2do nombre columna)
            'company' => ['required', ValidationRule::unique('ofertas', 'company')],
            'title' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // asigna el id del usuario logeado actualmente al campo 'user_id' de la BD
        $formFields['user_id'] = auth()->id();

        // usa el método create del modelo Oferta para hacer el insert en la BD
        Oferta::create($formFields);

        // redirecciona a la página principal una vez se ha creado la nueva oferta
        // además mostrará un mensaje de confirmación, su formato se define en el componente flash-message
        return redirect('/')->with('message', 'Oferta publicada con éxito.');
    }

    // mostrar formulario para editar ofertas. Devuelve la vista en views->ofertas->edit
    public function edit(Oferta $oferta)
    {
        return view('ofertas.edit', ['oferta' => $oferta]);
    }

    // editar oferta
    // formulario como el del método store, pero también se le pasa la oferta
    public function update(Request $request, Oferta $oferta)
    {

        // asegurarse de que un usuario logeado sea el propietario de una oferta
        if ($oferta->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'company' => 'required',
            'title' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // ejecuta el método con los campos escritos
        $oferta->update($formFields);

        return back()->with('message', 'Oferta editada con éxito.');
    }

    //borrar oferta
    public function destroy(Oferta $oferta)
    {

        // asegurarse de que un usuario logeado sea el propietario de una oferta
        if ($oferta->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $oferta->delete();
        return redirect('/')->with('message', 'Oferta borrada con éxito.');
    }

    //gestionar ofertas
    //devuelve la vista manage, que recibirá las ofertas del usuario logeado
    public function manage()
    {
        return view('ofertas.manage', ['ofertas' => auth()->user()->ofertas()->get()]);
    }
}
