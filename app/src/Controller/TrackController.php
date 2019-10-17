<?php

namespace App\Controller;

use App\DTO\TrackDto;
use App\Form\TrackType;
use App\Repository\TimeSpentRepository;
use App\UseCase\InsertSpentHour;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TrackController extends AbstractController
{
    /**
     * @Route("/track", name="track")
     */
    public function index(Request $request, TimeSpentRepository $timeRepo)
    {
        $trackDto = new TrackDto();

        $form = $this->createForm(TrackType::class, $trackDto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            try {
                $useCase = new InsertSpentHour($timeRepo);
                $useCase->execute($this->getUser(), $trackDto);

                $this->addFlash('notice', 'ore inserite');
            } catch (\Throwable $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('track/index.html.twig', [
            'form' => $form->createView(),
            'account' => $this->getUser()
        ]);
    }
}
