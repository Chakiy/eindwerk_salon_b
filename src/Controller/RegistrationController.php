<?php

namespace App\Controller;


use App\Entity\Customer;
use App\Form\RegistrationFormType;
use App\Service\KhachaturMailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(MailerInterface $mailer, KhachaturMailService $khachaturMailService, Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Customer();

        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email



            $to = $user->getEmail();
            $subject = 'Welcome to Beauty Salon Lakshmi';
            $name = $user->getFullName($user->getName(), $user->getLastName());

            $khachaturMailService->sendEmail($mailer,$to,$subject,$name);



            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
