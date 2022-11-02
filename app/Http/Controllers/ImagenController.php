<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request){
        $imagen = $request->file('file');

        //Lo que hace es generar un id unico en cada una de las imágenes en el servidor
        //No se pueden tener dos archivos iguales en el servidor
        $nombreImagen = Str::uuid() . "." .$imagen->extension();

        //La imágen que está en memoría será procesada en el servidor
        //Esto ya forma una variable de intervention image
        $imagenServidor = Image::make($imagen);
        //El método FIT recorta la imagen para que se ajuste al tamaño que le pasemos
        $imagenServidor->fit(1000, 1000);

        //A mover la imágen en el servidor
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
