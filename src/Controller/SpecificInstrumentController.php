<?php

namespace App\Controller;

use App\Entity\SpecificInstrument;
use App\Form\SpecificInstrumentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\GeneralInstrumentRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SpecificInstrumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/specific/instrument")
 */
class SpecificInstrumentController extends AbstractController
{
    /**
     * @Route("/", name="specific_instrument_index", methods={"GET"})
     */
    public function index(SpecificInstrumentRepository $specificInstrumentRepository): Response
    {
        return $this->render('specific_instrument/index.html.twig', [
            'specific_instruments' => $specificInstrumentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="specific_instrument_new", methods={"GET","POST"})
     */
    public function new(Request $request,SpecificInstrumentRepository $SpecificInstrumentRepository,GeneralInstrumentRepository $GeneralInstrumentRepository): Response
    {
        $SpecificInstrument = new SpecificInstrument();
    //$instrumentspecifique->setNumero($numero);
        $form = $this->createForm(SpecificInstrumentType::class, $SpecificInstrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $code=$SpecificInstrument->getGeneralInstrument()->getCode();
            $code.= "_";  
            $code.=$this->formatNbr(count($SpecificInstrumentRepository->findBy(['generalInstrument'=>$SpecificInstrument->getGeneralInstrument()->getId()]))+1);
            $SpecificInstrument->setNumero($code);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($SpecificInstrument);
            $entityManager->flush();


            $this->addFlash('success', 'Instrument enregistré avec succès');

            return $this->redirectToRoute('specific_instrument_index');
        }

        return $this->render('specific_instrument/new.html.twig', [
            'specific_instrument' => $SpecificInstrument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="specific_instrument_show", methods={"GET"})
     */
    public function show(SpecificInstrument $specificInstrument): Response
    {
        return $this->render('specific_instrument/show.html.twig', [
            'specific_instrument' => $specificInstrument,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="specific_instrument_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SpecificInstrument $specificInstrument): Response
    {
        $form = $this->createForm(SpecificInstrumentType::class, $specificInstrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Instrument mis à jour avec succès');
            return $this->redirectToRoute('specific_instrument_index');
        }

        return $this->render('specific_instrument/edit.html.twig', [
            'specific_instrument' => $specificInstrument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="specific_instrument_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SpecificInstrument $specificInstrument): Response
    {
        if ($this->isCsrfTokenValid('delete'.$specificInstrument->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($specificInstrument);
            $entityManager->flush();
            $this->addFlash('success', 'Instrument supprimé avec succès');
        }

        return $this->redirectToRoute('specific_instrument_index');
    }
    private  function formatNbr($nbr){
        if ($nbr < 10)
            return "00".$nbr;
        elseif ($nbr >= 10 && $nbr < 100 )
            return "0".$nbr;
        else
            return strval($nbr);
        }
}
