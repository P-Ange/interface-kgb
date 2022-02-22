<?php

namespace App\Controller;


use App\Entity\HidingPlaces;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HidingplacesController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/hidingplace', name: 'hidingplaces')]
    public function index(): Response
    {
        $hidingplaces = $this->entityManager->getRepository(HidingPlaces::class)->findAll();
        return $this->render('hidingplaces/index.html.twig', [
            'hidingplaces' => $hidingplaces,
        ]);
    }
}
