<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactsdetailsController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/contact/detail/{id}', name: 'contactsdetails')]
    public function index($id): Response
    {
        $contacts = $this->entityManager->getRepository(Contacts::class)->findOneBy(array('id' => $id));
        return $this->render('contactsdetails/index.html.twig', [
            'contacts' => $contacts,
        ]);
    }


    #[Route('/contact/new', name: 'contact_add', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $target = new Contacts();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($contact);
            $this->entityManager->flush();
            $this->addFlash('success', "Le contact a été ajouté avec succès");
            return $this->redirectToRoute('contacts');
        }

        return $this->render('contactsdetails/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contact/modifier/{id}', name: 'contact_modify', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contacts $contact): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->flush();
            $this->addFlash('success', "Le contact a été modifié avec succès");
            return $this->redirectToRoute('contacts');
        };

        return $this->render('contactsdetails/edit.html.twig', [
            'contacts' => $contact,
            'form' => $form->createView()
        ]);
    }

    #[Route('/contact/supprimer/{id}', name: 'contact_delete', methods: ['GET', 'DELETE'])]
    public function delete(Request $request, Contacts $contact): Response
    {
        if ($this->isCsrfTokenValid('delete' . $contact->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($contact);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('contacts');

    }
}
