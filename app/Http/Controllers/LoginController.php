<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => ['required']
        ]);


        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            //Cuando se llena un formulario
            //Estoy mandando un POST a la URL LOGIN y el navegador
            //Ya me lleva a la pagina donde estoy llenando el formulario
            //En este caso me regresa a la pagina anterior
            return back()->with('mensaje', 'Credenciales incorrectas');
        }

        //Despues de loguearse, se tiene que redireccionar pero con el id o username del usuario
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
