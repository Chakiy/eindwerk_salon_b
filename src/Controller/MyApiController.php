<?php


namespace App\Controller;


use App\Entity\Questions;
use App\Entity\Services;
use App\Repository\ServicesRepository;
use App\Service\KhachaturMailService;
use Doctrine\ORM\EntityManagerInterface;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;


class MyApiController extends AbstractController
{
    //GET ALL Services
//    /**
//     * @Route("/myapi/services", name="myapi_services", methods={"GET"})
//     */
//    public function services(ServicesRepository $servicesRepository, KhachaturMailService $khachaturMailService, MailerInterface $mailer)
//    {
//        $subject = 'Welcome to Beauty Salon Lakshmi';
//        $services = $servicesRepository->findAll();
//        $khachaturMailService->sendEmail($mailer, "kha.hov@icloud.com", $subject, "Kha");
//
//
//        return $this->json($services, $status = 200, $headers = [], $context = []);
//    }


    //POST NEW Question

    /**
     * @Route("/myapi/questions", name="myapi_questions_post", methods={"POST"})
     *
     */
    public function question_new(Request $request, EntityManagerInterface $em, KhachaturMailService $khachaturMailService, MailerInterface $mailer)
    {

        $question = new Questions();
        $question->setName($request->request->get("name"));
        $question->setEmail($request->request->get("email"));
        $question->setQuestionAbout($request->request->get("questionAbout"));
        $question->setMessage($request->request->get("message"));

        $em->persist($question);
        $em->flush();


        $subject = 'Thank you for your question';
        $to = $question->getEmail();
        $name = $question->getName();
        $questionAbout = $question->getQuestionAbout();
        $message = $question->getMessage();
        $template= 'email/question.html.twig';

        $khachaturMailService->sendEmail($mailer, $to, $template, $subject, $name, $questionAbout, $message);


        return $this->json( $question, $status = 201, $headers = [], $context = [] );
    }

}