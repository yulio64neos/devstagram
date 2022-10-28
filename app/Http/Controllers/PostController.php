<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        //middleware se ejecuta antes que el index, entonces revisa si está autenticado o no.
        $this->middleware('auth');
    }
    public function index(User $user) {
        //Sucede que user es guardado en auth
        //Indicando que es una variable de sesión
        //Tal como si fuera php puro $_SESSION['user'] = $resultado['user'];
        //dd(auth()->user());
        //dd($user);
        return view('dashboard', [
            'user' => $user
        ]);
    }

    public function create(){
        return view('posts.create');
    }
}