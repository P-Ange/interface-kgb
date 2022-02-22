<?php

namespace App\Controller;


use App\Entity\Targets;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TargetsController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/target', name: 'targets')]
    public function index(): Response
    {
        $targets = $this->entityManager->getRepository(Targets::class)->findAll();
        return $this->render('targets/index.html.twig', [
            'targets' => $targets,
        ]);
    }
}
