<?php

namespace App\Controller;

use App\Entity\PosteTravail;
use App\Form\PosteTravailType;
use App\Repository\PosteTravailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/poste/travail")
 */
class PosteTravailController extends AbstractController
{
    /**
     * @Route("/", name="poste_travail_index", methods={"GET"})
     */
    public function index(PosteTravailRepository $posteTravailRepository): Response
    {
        return $this->render('poste_travail/index.html.twig', [
            'poste_travails' => $posteTravailRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="poste_travail_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $posteTravail = new PosteTravail();
        $form = $this->createForm(PosteTravailType::class, $posteTravail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($posteTravail);
            $entityManager->flush();

            return $this->redirectToRoute('poste_travail_index');
        }

        return $this->render('poste_travail/new.html.twig', [
            'poste_travail' => $posteTravail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="poste_travail_show", methods={"GET"})
     */
    public function show(PosteTravail $posteTravail): Response
    {
        return $this->render('poste_travail/show.html.twig', [
            'poste_travail' => $posteTravail,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="poste_travail_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PosteTravail $posteTravail): Response
    {
        $form = $this->createForm(PosteTravailType::class, $posteTravail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('poste_travail_index');
        }

        return $this->render('poste_travail/edit.html.twig', [
            'poste_travail' => $posteTravail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="poste_travail_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PosteTravail $posteTravail): Response
    {
        if ($this->isCsrfTokenValid('delete'.$posteTravail->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($posteTravail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('poste_travail_index');
    }
}
