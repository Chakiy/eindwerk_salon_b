<?php
namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;


class KhachaturMailService extends AbstractController
{

    public function sendEmail(MailerInterface $mailer, $to, $subject, $name)
    {
        $message = (new TemplatedEmail())
            ->from('casilias35@hotmail.com')
            ->to("{$to}")
            ->subject("$subject")
            ->htmlTemplate('email/welcome.html.twig')
            ->context([
                'user' => $name
            ]);

       return $mailer->send($message);


    }
}
