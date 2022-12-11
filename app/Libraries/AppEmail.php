<?php

namespace App\Libraries;

use Config\MyConfig;
use Config\Services;

class AppEmail
{
    private $twig;
    private $appEmail;
    private $appName;

    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
        $config = new MyConfig();

        $this->appEmail = $config->appEmail;
        $this->appName = $config->appName;
    }

    public function sendEmail($to, $subject, $body = '', $cc = false)
    {
        $email = Services::email();
        $email->setFrom($this->appEmail, $this->appName);
        $email->setTo($to);
        if ($cc) {
            $email->setCC($cc);
        }
        $email->setSubject($subject);
        $email->setMessage($body);

        return $email->send();
    }

    public function activationEmail($user)
    {
        $email_data = [
            'body_title' => sprintf('Witaj %s!', $user->name),
            'body_top' => 'Kliknij poniższy przycisk w celu potwierdzenia rejestracji.',
            'btn' => [
                'name' => 'Potwierdzam',
                'link' => site_url('activation?token=' . $user->token),
            ],
            'body_bottom' => '',
            'body_sign' => "Pozdrawiam,\n Administrator",
        ];
        $body = $this->twig->render('emails/auth', $email_data);

        return $this->sendEmail($user->email, 'Email aktywacyjny', $body);
    }

    public function confirmEmail($user)
    {
        $email_data = [
            'body_title' => sprintf('Witaj %s!', $user->name),
            'body_top' => 'Twoje konto zostało aktywowane!',
            'body_bottom' => '',
            'body_sign' => "Pozdrawiam,\n Administrator",
        ];
        $body = $this->twig->render('emails/auth', $email_data);

        return $this->sendEmail($user->email, 'Email potwierdzający aktywację', $body);
    }

    public function resetPasswordEmail($user)
    {
        $email_data = [
            'body_title' => sprintf('Witaj %s!', $user->name),
            'body_top' => 'Kliknij poniższy przycisk, aby zresetować hasło.',
            'btn' => [
                'name' => 'Resetuj hasło',
                'link' => site_url('reset-password?token=' . $user->token),
            ],
            'body_bottom' => '',
            'body_sign' => "Pozdrawiam,\n Administrator",
        ];
        $body = $this->twig->render('emails/auth', $email_data);

        return $this->sendEmail($user->email, 'Resetowanie hasła', $body);
    }

    public function passwordChanged($user)
    {
        $email_data = [
            'body_title' => sprintf('Witaj %s!', $user->name),
            'body_top' => 'Twoje hasło zostało zmienione.',
            'body_bottom' => '',
            'body_sign' => "Pozdrawiam,\n Administrator",
        ];
        $body = $this->twig->render('emails/auth', $email_data);

        return $this->sendEmail($user->email, 'Resetowanie hasła', $body);
    }

    public function deliveryConfirmationEmail($user, $product)
    {
        $email_data = [
            'body_title' => sprintf('Witaj %s!', $user->name),
            'body_top' => sprintf("Potwierdzam dostawę produktu: <b>%n - %s</b>, do magazynu.\n Aktualny stan po dostawie: %d.", $product->number, $product->name, $product->quantity),
            'body_sign' => "Pozdrawiam,\n Administrator",
        ];
        $body = $this->twig->render('emails/delivery', $email_data);

        return $this->sendEmail($user->email, 'Potwierdzenie dostawy', $body);
    }
}
