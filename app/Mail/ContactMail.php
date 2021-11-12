<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $headers;
    public $nome;
    public $telefone;
    public $mensagem;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($envio)
    {
        $this->to('creditcash@creditcash.net.br');
        // $this->to('romario.silva@creditcash.com.br');
        $this->subject($envio->assunto);
        $this->from($envio->email,$envio->nome);
        // $this->attach($envio->anexo);
        // $this->replyTo($envio->reply, $envio->name);

        $this->nome = $envio->nome;
        $this->mensagem = $envio->mensagem;
        $this->telefone = $envio->telefone;
        $this->email = $envio->email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $this->withSwiftMessage(function ($swiftmessage) {
        //     // $swiftmessage->setId($this->id);

        //     $this->headers = $swiftmessage->getHeaders();
        // });
        return $this->view('portal.email.modelo.contact');
    }
}
