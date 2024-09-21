<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Observers\SendEmailObserver;  // Importar el observador que vas a crear
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

        // Crear el post y adjuntar el observador
        $post = Post::createAndNotify([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ], new SendEmailObserver());

        echo "Post creado y notificado: " . $post->title . PHP_EOL;

        return redirect()->route('posts.create')->with('success', 'Post creado: ' . $post->title);
    }
}
