<?php

namespace App\Controller;

use App\Form\HomeType;
use App\Repository\TripRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(TripRepository $tripRepository): Response
    {
        $homeForm = $this->createForm(HomeType::class);
        $trips = $tripRepository->findAll();
        return $this->render('main/index.html.twig', [
            'homeForm' => $homeForm->createView(),
            'trips' => $trips
        ]);
    }
}
