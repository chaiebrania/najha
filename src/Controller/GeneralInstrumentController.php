<?php

namespace App\Controller;

use App\Entity\GeneralInstrument;
use App\Form\GeneralInstrumentType;
use App\Repository\GeneralInstrumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/general/instrument")
 */
class GeneralInstrumentController extends AbstractController
{
    /**
     * @Route("/", name="general_instrument_index", methods={"GET"})
     */
    public function index(GeneralInstrumentRepository $generalInstrumentRepository): Response
    {
        return $this->render('general_instrument/index.html.twig', [
            'general_instruments' => $generalInstrumentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="general_instrument_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $generalInstrument = new GeneralInstrument();
        $form = $this->createForm(GeneralInstrumentType::class, $generalInstrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($generalInstrument);
            $entityManager->flush();

            $this->addFlash('success', 'Instrument enregistré avec succès');

            return $this->redirectToRoute('general_instrument_index');
        }

        return $this->render('general_instrument/new.html.twig', [
            'general_instrument' => $generalInstrument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="general_instrument_show", methods={"GET"})
     */
    public function show(GeneralInstrument $generalInstrument): Response
    {
        return $this->render('general_instrument/show.html.twig', [
            'general_instrument' => $generalInstrument,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="general_instrument_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GeneralInstrument $generalInstrument): Response
    {
        $form = $this->createForm(GeneralInstrumentType::class, $generalInstrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Instrument mis à jour avec succès');
            return $this->redirectToRoute('general_instrument_index');
        }

        return $this->render('general_instrument/edit.html.twig', [
            'general_instrument' => $generalInstrument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="general_instrument_delete", methods={"DELETE"})
     */
    public function delete(Request $request, GeneralInstrument $generalInstrument): Response
    {
        if ($this->isCsrfTokenValid('delete'.$generalInstrument->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($generalInstrument);
            $entityManager->flush();

            $this->addFlash('success', 'Instrument supprimé avec succès');
        }

        return $this->redirectToRoute('general_instrument_index');
    }
}
