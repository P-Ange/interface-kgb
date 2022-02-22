<?php

namespace App\Controller;

use App\Entity\Agents;
use App\Form\AgentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgentsdetailsController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
    $this->entityManager = $entityManager;
}
#[Route('/agent/detail/{id}', name: 'agentsdetails')]
    public function index($id): Response
{
    $agents = $this->entityManager->getRepository(Agents::class)->findOneBy(array('id' => $id));
    return $this->render('agentsdetails/index.html.twig', [
        'agent' => $agents,
    ]);
}

#[Route('/agent/new', name: 'agent_add', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $agent = new Agents();
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($agent);
            $this->entityManager->flush();
            $this->addFlash('success', "L'Agent a été ajouté avec succès");
            return $this->redirectToRoute('agents');
        }

        return $this->render('agentsdetails/new.html.twig', [
            'agent' => $agent,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/agent/modifier/{id}', name: 'agent_modify', methods: ['GET', 'POST'])]
    public function edit(Request $request, Agents $agent): Response
{
    $form = $this->createForm(AgentType::class, $agent);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $this->entityManager->flush();
        $this->addFlash('success', "L'Agent a été modifié avec succès");
        return $this->redirectToRoute('agents');
    };

    return $this->render('agentsdetails/edit.html.twig', [
        'agents' => $agent,
        'form' => $form->createView()
    ]);
}

    #[Route('/agent/supprimer/{id}', name: 'agent_delete', methods: ['GET', 'DELETE'])]
    public function delete(Request $request, Agents $agent): Response
{
    if ($this->isCsrfTokenValid('delete' . $agent->getId(), $request->request->get('_token'))) {
        $this->entityManager->remove($agent);
        $this->entityManager->flush();
    }

    return $this->redirectToRoute('agents');
}
}

