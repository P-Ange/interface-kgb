<?php

namespace App\Controller;


use App\Entity\HidingPlaces;
use App\Form\HidingplaceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HidingplacesdetailsController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    #[Route('/hidingplace/detail/{id}', name: 'hidingplacesdetails')]
    public function index($id): Response
    {
        $hidingplaces = $this->entityManager->getRepository(HidingPlaces::class)->findOneBy(array('id' => $id));
        return $this->render('hidingplacesdetails/index.html.twig', [
            'hidingplaces' => $hidingplaces,
        ]);
    }



    #[Route('/hidingplace/new', name: 'hidingplace_add', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $hidingplace = new Hidingplaces();
        $form = $this->createForm(HidingplaceType::class, $hidingplace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($hidingplace);
            $this->entityManager->flush();

            return $this->redirectToRoute('hidingplaces');
        }

        return $this->render('hidingplacesdetails/new.html.twig', [
            'hidingplace' => $hidingplace,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/hidingplace/modifier/{id}', name: 'hidingplace_modify', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hidingplaces $hidingplace): Response
    {
        $form = $this->createForm(HidingplaceType::class, $hidingplace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->flush();
            return $this->redirectToRoute('hidingplaces');
        };

        return $this->render('hidingplacesdetails/edit.html.twig', [
            'hidingplaces' => $hidingplace,
            'form' => $form->createView()
        ]);
    }

    #[Route('/hidingplace/supprimer/{id}', name: 'hidingplace_delete', methods: ['GET', 'DELETE'])]
    public function delete(Request $request, Hidingplaces $hidingplace): Response
    {
        if ($this->isCsrfTokenValid('delete' . $hidingplace->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($hidingplace);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('hidingplaces');
    }
}

