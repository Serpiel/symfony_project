<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EventRepository $eventRepository): Response
    {
        // On récupère les événements triés par date (du plus proche au plus loin)
        $events = $eventRepository->findBy([], ['date' => 'ASC']);

        return $this->render('home/index.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('/event/{id}', name: 'app_event_detail')]
    public function show(Event $event): Response
    {
        // Grâce au "ParamConverter" de Symfony, l'événement est récupéré
        // automatiquement via son {id} dans l'URL.
        return $this->render('home/show.html.twig', [
            'event' => $event,
        ]);
    }
}