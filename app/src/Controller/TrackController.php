<?php

namespace App\Controller;

use App\DTO\TrackDto;
use App\Form\TrackType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TrackController extends AbstractController
{
    /**
     * @Route("/track", name="track")
     */
    public function index(Request $request)
    {
        $trackDto = new TrackDto();

        $form = $this->createForm(TrackType::class, $trackDto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->addFlash('notice', 'ore inserite');


            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();
        }

        return $this->render('track/index.html.twig', [
            'form' => $form->createView(),
            'account' => $this->getUser()
        ]);
    }
}
