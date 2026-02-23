<?php

namespace App\Mail;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ArticleCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $article; // Переменная для хранения данных статьи

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Добавлена новая статья: '.$this->article->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.article_created', // Путь к шаблону письма
        );
    }
}
