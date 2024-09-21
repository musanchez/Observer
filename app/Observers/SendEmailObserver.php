<?php

namespace App\Observers;

use Illuminate\Support\Facades\Mail;
use App\Mail\NewPostNotification;

class SendEmailObserver implements Observer
{
    public function update($post)
    {
        // Lógica para enviar un correo cuando se cree un post
        Mail::to('admin@example.com')->send(new NewPostNotification($post));
    }
}
