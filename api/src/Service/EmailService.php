<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    public function __construct(private MailerInterface $mailer){}

    public function sendConfirmationEmail(string $name, string $email, string $token): void
    {
        $email = (new Email())
            ->from('EduSearch <edusearchcontact@gmail.com>')
            ->to($email)
            ->subject('Confirma tu cuenta en EduSearch')
            ->html($this->createBody($name,$token));

        $this->mailer->send($email);
    }

    private function createBody(string $name, string $token): string{

        return "<html>\n" .
            "<style>\n" .
            "@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap');\n" .
            "h2 {\n" .
            "    font-size: 25px;\n" .
            "    font-weight: 500;\n" .
            "    line-height: 25px;\n" .
            "}\n" .
            "\n" .
            "body {\n" .
            "    font-family: 'Poppins', sans-serif;\n" .
            "    background-color: #ffffff;\n" .
            "    max-width: 400px;\n" .
            "    margin: 0 auto;\n" .
            "    padding: 20px;\n" .
            "}\n" .
            "\n" .
            "p {\n" .
            "    line-height: 18px;\n" .
            "}\n" .
            "\n" .
            "a {\n" .
            "    position: relative;\n" .
            "    z-index: 0;\n" .
            "    display: inline-block;\n" .
            "    margin: 20px 0;\n" .
            "}\n" .
            "\n" .
            "a button {\n" .
            "    padding: 0.7em 2em;\n" .
            "    font-size: 16px !important;\n" .
            "    font-weight: 500;\n" .
            "    background: #000000;\n" .
            "    color: #ffffff;\n" .
            "    border: none;\n" .
            "    text-transform: uppercase;\n" .
            "    cursor: pointer;\n" .
            "}\n" .
            "p span {\n" .
            "    font-size: 12px;\n" .
            "}\n" .
            "div p{\n" .
            "    border-bottom: 1px solid #000000;\n" .
            "    border-top: none;\n" .
            "    margin-top: 40px;\n" .
            "}\n" .
            "</style>\n" .
            "<body>\n" .
            "    <h1>EduSearch</h1>\n" .
            "    <h2>Gracias por registrarte ". $name . "!</h2>\n" .
            "    <p>Por favor confirma tu correo electronico para que puedas comenzar a utilizar tu cuenta en EduSearch</p>\n" .
            "    <a href='".$_ENV['MAIL_CONFIRMATION_URL']."/cuentas/confirmar/". $token ."'><button>Confirmar cuenta</button></a>\n" .
            "    <p>Si tu no te registraste, por favor ignora este correo electrónico.</p>\n" .
            "    <div><p></p></div>\n" .
            "    <p><span>Este correo electronico fue enviado desde una dirección solamente de notificaciones que no puede aceptar correo electronico entrante. Por favor no respondas a este mensaje.</span></p>\n" .
            "</body>\n" .
            "</html>";
    }
}
