<?php

namespace App\Controller;


use App\Entity\Agents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgentsController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/agent', name: 'agents')]
    public function index(): Response
    {
        $agents = $this->entityManager->getRepository(Agents::class)->findAll();
        return $this->render('agents/index.html.twig', [
            'agents' => $agents,
        ]);
    }
}
