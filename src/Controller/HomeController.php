<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home", methods={"GET"})
     */
    #[Route('/home', name: 'app_home', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/home", name="home_invalid_method", methods={"POST", "PUT", "DELETE", "PATCH"})
     */
    #[Route('/home', name: 'app_home_invalid_method', methods: ['POST', 'PUT', 'DELETE', 'PATCH'])]
    public function indexWithInvalidMethod(): Response
    {
        return new Response('Method Not Allowed', 405);
    }
}