<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index() {
        return view('auth.register');
    }

    //En el método de store se le pasará una clase llamda Request
    public function store(Request $request) {
        //dd die and dump - it's a function that stops the execution of the code and shows the content of the variable
        //die and dump lo que hace esa función es imprimir lo que le pases pero detiene la ejecución del código de laravel
        //Esta es la forma de debuggear el código
        //dd($request);
        // Y esta es la forma de acceder a cada valor
        //dd($request->get('name'));

        $request->request->add(['username' => Str::slug($request->name)]);

        //Validación de los datos
        //El método validate recibe dos parámetros, el primero es el objeto request y el segundo es un array con las reglas de validación+
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => ['required', 'unique:users', 'min:3', 'max:20'], //Aquí indico que en unique debe ser único en la tabla users en la columna username
            'email' => 'required|unique:users|email|max:60', //Aquí estoy validando que sea unico, así como el que el email este registrado en la BD y lo ultimo es que con una expresión regular sea un email
            'password' => ['required', 'confirmed']
        ]);

        //Esta es la contraparte de INSERT INTO pero en modo LARAVEL
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            //'password' => bcrypt($request->password)
            'password' => Hash::make($request->password)
        ]);


        //DOS FORMAS DE HACER LAS AUTENTICACIONES
        /*auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);*/

        //Otra forma de autenticar al usuario
        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('post.index');
    }
}
