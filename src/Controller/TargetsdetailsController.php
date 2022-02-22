<?php

namespace App\Controller;

use App\Entity\Targets;
use App\Form\TargetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TargetsdetailsController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    #[Route('/target/detail/{id}', name: 'targetsdetails')]
    public function index($id): Response
    {
        $targets = $this->entityManager->getRepository(Targets::class)->findOneBy(array('id' => $id));
        return $this->render('targetsdetails/index.html.twig', [
            'targets' => $targets,
        ]);
    }



#[Route('/target/new', name: 'target_add', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $target = new Targets();
        $form = $this->createForm(TargetType::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($agent);
            $this->entityManager->flush();
            $this->addFlash('success', "La cible a été ajoutée avec succès");
            return $this->redirectToRoute('targets');
        }

        return $this->render('targetsdetails/new.html.twig', [
            'target' => $target,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/target/modifier/{id}', name: 'target_modify', methods: ['GET', 'POST'])]
    public function edit(Request $request, Targets $target): Response
{
    $form = $this->createForm(TargetType::class, $target);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $this->entityManager->flush();
        $this->addFlash('success', "La cible a été modifiée avec succès");
        return $this->redirectToRoute('targets');
    };

    return $this->render('targetsdetails/edit.html.twig', [
        'targets' => $target,
        'form' => $form->createView()
    ]);
}

    #[Route('/target/supprimer/{id}', name: 'target_delete', methods: ['GET', 'DELETE'])]
    public function delete(Request $request, Targets $target): Response
{
    if ($this->isCsrfTokenValid('delete' . $target->getId(), $request->request->get('_token'))) {
        $this->entityManager->remove($target);
        $this->entityManager->flush();
    }

    return $this->redirectToRoute('targets');
}
}

