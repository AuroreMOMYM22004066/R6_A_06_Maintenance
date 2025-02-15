<?php

namespace App\Controller;

use App\Repository\RegionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home', methods: ['GET'])]
    public function index(RegionRepository $regionRepository): Response
    {
        $regions = $regionRepository->findAll();
        return $this->render('home/index.html.twig', [
            'regions' => $regions,
        ]);
    }

    #[Route('/home/invalid', name: 'app_home_invalid_method', methods: ['POST', 'PUT', 'DELETE', 'PATCH'])]
    public function indexWithInvalidMethod(): Response
    {
        return new Response('Method Not Allowed', 405);
    }
}
