<?php


namespace App\Controller;


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
    /**
     * @Route("/myapi/services", name="myapi_services", methods={"GET"})
     */
    public function services(ServicesRepository $servicesRepository, KhachaturMailService $khachaturMailService, MailerInterface $mailer)
    {
        $subject = 'Welcome to Beauty Salon Lakshmi';
        $services = $servicesRepository->findAll();
        $khachaturMailService->sendEmail($mailer, "kha.hov@icloud.com", $subject, "Kha");


        return $this->json($services, $status = 200, $headers = [], $context = []);
    }

}