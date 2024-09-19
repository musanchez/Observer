<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Muestra el formulario para crear un nuevo post
    public function create()
    {
        return view('posts.create');
    }

    // Almacena un nuevo post y dispara el observer
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Crear el nuevo post
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->input('content'),
        ]);
        

        // Enviar el post recién creado a la vista como confirmación (opcional)
        return redirect()->route('posts.create')->with('success', 'Post creado: ' . $post->title);
    }
}

