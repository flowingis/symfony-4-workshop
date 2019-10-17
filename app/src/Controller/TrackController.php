<?php

namespace App\Controller;

use App\DTO\TrackDto;
use App\Entity\TimeSpent;
use App\Form\TrackType;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

            $ts = TimeSpent::create(
                Uuid::uuid4(),
                $this->getUser()->getId(),
                $trackDto->getProgetto(),
                $trackDto->getData(),
                $trackDto->getOre()
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ts);
            $entityManager->flush();

            $this->addFlash('notice', 'ore inserite');
        }


        return $this->render('track/index.html.twig', [
            'form' => $form->createView(),
            'account' => $this->getUser()
        ]);
    }
}
