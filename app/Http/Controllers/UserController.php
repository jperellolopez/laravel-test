<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // mostrar formulario de registro
    public function create() {
        return view('usuarios.register');
    }

    // crear nuevo usuario, la validación se hace de forma similar como se crea una oferta
    public function store(Request $request) {
       // el campo confirmed de password se asegura de que la clave coincida con un campo que se llame igual + _confirmation.
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // crea el usuario
        $user = User::create($formFields);

        // login automático al crear el usuario
        auth()->login($user);

        return redirect('/')->with('message', 'Usuario ' . $user['name'] .' creado.');

    }

    // logout
    public function logout(Request $request) {
        auth()->logout();

        // invalida la sesión y regenera el token
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect('/')->with('message', 'Sesión cerrada.');

    }

    // mostrar formulario de login
    public function login() {
        return view('usuarios.login');
    }

    // inicio de sesión
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Sesión iniciada.');
        }

        // tanto si el campo erróneo es el email como la contraseña, saldrá el mismo error bajo el campo de email. De esta manera no se especifica en qué campo se ha equivocado el user y no se desvela si ese email existe en la bd
        // witherrorrs(['campo bajo el cual se muestra el error' => 'mensaje de error personalizado])->onlyInput('nombre del ÚNICO campo bajo el cual aparece')
        else {
            return back()->withErrors(['email' => 'Credenciales erróneas'])->onlyInput('email');
        }


    }
}
