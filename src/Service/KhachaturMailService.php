<?php
namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;


class KhachaturMailService extends AbstractController
{

    public function sendEmail(MailerInterface $mailer, $to, $template, $subject, $name, $question = "there is no question to answer", $message = "Please try again")
    {
        $message = (new TemplatedEmail())
            ->from('casilias35@hotmail.com')
            ->to("{$to}")
            ->subject("$subject")
            ->htmlTemplate("$template")
            ->context([
                'user' => $name,
                'question' => $question,
                'message' => $message
            ]);

       return $mailer->send($message);


    }
}
