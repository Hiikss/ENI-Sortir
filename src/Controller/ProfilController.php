<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfilFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{

    #[Route('/profil', name: 'profil_profil')]
    public function profil(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        return $this->render('profil/profil.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profil/modifier', name: 'profil_modifier')]
    public function modifier(Request $request, EntityManagerInterface $entityManager): Response
    {

        //$user = new User();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $form = $this->createForm(ProfilFormType::class, $user);
        $form->handleRequest($request);

        //traiter le formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('profil_profil');
        }

        return $this->render('profil/modifier.html.twig', [
            'profilForm' => $form->createView()
        ]);
    }
}
