<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        //dd($user->id);

        $posts = Post::where('user_id', $user->id)->get();

        //dd($posts);
        //El controlador solo sabe los posts pero la vista no sabe 
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => ['required'],
            'imagen' => ['required']
        ]);


        //Primera forma
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        //Otra forma de hacer registros
        //Segunda forma
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        //De esta forma es que estoy accediendo a la informacion
        //Esta es la tercera forma de llevar acabo los registros
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }
}