<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;

class NewPostNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    /**
     * Create a new message instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
        //
    }

    public function build()
    {
        return $this->subject('Nuevo post creado')
                    ->view('emails.new_post')
                    ->with([
                        'title' => $this->post->title,
                        'content' => $this->post->content,
                    ]);
    }

}
