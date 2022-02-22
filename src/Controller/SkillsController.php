<?php

namespace App\Controller;


use App\Entity\Skills;
use App\Form\SkillType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SkillsController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/skill', name: 'skills')]
    public function index(): Response
    {
        $skills = $this->entityManager->getRepository(Skills::class)->findAll();
        return $this->render('skills/index.html.twig', [
            'skills' => $skills,
        ]);
    }



#[Route('/skill/new', name: 'skill_add', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $target = new Skills();
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($skill);
            $this->entityManager->flush();

            return $this->redirectToRoute('skills');
        }

        return $this->render('skills/new.html.twig', [
            'target' => $target,
            'form' => $form->createView(),
        ]);

    }

    #[Route('/skill/modifier/{id}', name: 'skill_modify', methods: ['GET', 'POST'])]
    public function edit(Request $request, Skills $skill): Response
{
    $form = $this->createForm(SkillType::class, $skill);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $this->entityManager->flush();
        return $this->redirectToRoute('skills');
    };

    return $this->render('skills/edit.html.twig', [
        'skills' => $skill,
        'form' => $form->createView()
    ]);
}

    #[Route('/skill/supprimer/{id}', name: 'skill_delete', methods: ['GET', 'DELETE'])]
    public function delete(Request $request, Skills $skill): Response
{
    if ($this->isCsrfTokenValid('delete' . $skill->getId(), $request->request->get('_token'))) {
        $this->entityManager->remove($skill);
        $this->entityManager->flush();
    }

    return $this->redirectToRoute('skills');

}
}

