<?php

namespace App\Controller;

use App\Entity\Missions;
use App\Form\MissionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionsdetailsController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    #[Route('/mission/detail/{id}', name: 'missionsdetails')]
    public function index($id): Response
    {
        $missions = $this->entityManager->getRepository(Missions::class)->findOneBy(array('id' => $id));
        return $this->render('missionsdetails/index.html.twig', [
            'missions' => $missions,
        ]);
    }

    #[Route('/missions/new', name: 'mission_add', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $mission = new Missions();
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(!$mission->missionIsValid()) {
                $this->addFlash('error',"La mission n'est pas valide suite à une (ou plusieurs) erreur(s) de saisie");
                return $this->redirectToRoute('home');

            } else {
                $this->addFlash('success', "La mission a été créée avec succès");
            }
            $this->entityManager->persist($mission);
            $this->entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('missionsdetails/new.html.twig', [
            'mission' => $mission,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/missions/modifier/{id}', name: 'mission_modify', methods: ['GET', 'POST'])]
    public function edit(Request $request, Missions $mission): Response
    {
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(!$mission->missionIsValid()) {
                $this->addFlash('error',"La mission n'a pas été modifiée suite à une (ou plusieurs) erreur(s) de saisie");
                return $this->redirectToRoute('home');

            } else {
                $this->addFlash('success', "La mission a été modifiée avec succès");
            }
            $this->entityManager->flush();
            return $this->redirectToRoute('home');
        };

        return $this->render('missionsdetails/edit.html.twig', [
            'missions' => $mission,
            'form' => $form->createView()
        ]);
    }

    #[Route('/missions/supprimer/{id}', name: 'mission_delete', methods: ['GET', 'DELETE'])]
    public function delete(Request $request, Missions $mission): Response
    {
        if ($this->isCsrfTokenValid('delete' . $mission->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($mission);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }
}
