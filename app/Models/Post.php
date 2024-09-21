<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content'];

    // Almacenaremos los observadores en un array
    protected $observers = [];

    // Método para adjuntar observadores
    public function attach($observer)
    {
        $this->observers[] = $observer;
    }

    // Método para notificar a los observadores
    public function notify($data)
    {
        foreach ($this->observers as $observer) {
            $observer->update($data);
        }
    }

    // Método para crear un post y notificar a los observadores
    public static function createAndNotify(array $attributes, $observer)
    {
        // Crear el post
        $post = self::create($attributes);

        // Adjuntar el observador al nuevo objeto Post
        $post->attach($observer);

        // Notificar a los observadores sobre el nuevo post
        $post->notify($post);

        return $post;
    }
}
