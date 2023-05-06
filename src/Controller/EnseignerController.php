<?php

namespace App\Controller;

use App\Entity\Enseigner;
use App\Form\EnseignerType;
use App\Repository\EnseignerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/enseigner')]
class EnseignerController extends AbstractController
{
    #[Route('/', name: 'app_enseigner_index', methods: ['GET'])]
    public function index(EnseignerRepository $enseignerRepository): Response
    {
        return $this->render('enseigner/index.html.twig', [
            'enseigners' => $enseignerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_enseigner_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EnseignerRepository $enseignerRepository): Response
    {
        $enseigner = new Enseigner();
        $form = $this->createForm(EnseignerType::class, $enseigner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enseignerRepository->save($enseigner, true);

            return $this->redirectToRoute('app_enseigner_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('enseigner/new.html.twig', [
            'enseigner' => $enseigner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_enseigner_show', methods: ['GET'])]
    public function show(Enseigner $enseigner): Response
    {
        return $this->render('enseigner/show.html.twig', [
            'enseigner' => $enseigner,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_enseigner_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Enseigner $enseigner, EnseignerRepository $enseignerRepository): Response
    {
        $form = $this->createForm(EnseignerType::class, $enseigner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enseignerRepository->save($enseigner, true);

            return $this->redirectToRoute('app_enseigner_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('enseigner/edit.html.twig', [
            'enseigner' => $enseigner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_enseigner_delete', methods: ['POST'])]
    public function delete(Request $request, Enseigner $enseigner, EnseignerRepository $enseignerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enseigner->getId(), $request->request->get('_token'))) {
            $enseignerRepository->remove($enseigner, true);
        }

        return $this->redirectToRoute('app_enseigner_index', [], Response::HTTP_SEE_OTHER);
    }
}
