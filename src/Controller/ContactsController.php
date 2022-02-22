<?php

namespace App\Controller;


use App\Entity\Contacts;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactsController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/contact', name: 'contacts')]
    public function index(): Response
    {
        $contacts = $this->entityManager->getRepository(Contacts::class)->findAll();
        return $this->render('contacts/index.html.twig', [
            'contacts' => $contacts,
        ]);
    }
}
