<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; // <--- AJOUT INDISPENSABLE
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EventRepository $eventRepository, Request $request): Response
    {
        // 1. On récupère le paramètre "sort" dans l'URL (par défaut 'date_asc' si vide)
        $sort = $request->query->get('sort', 'date_asc');

        // 2. On définit l'ordre de tri SQL selon le choix
        $orderBy = match ($sort) {
            'date_desc' => ['date' => 'DESC'],  // Du plus loin au plus proche
            'name_asc'  => ['title' => 'ASC'],  // Alphabétique A-Z
            'name_desc' => ['title' => 'DESC'], // Alphabétique Z-A
            default     => ['date' => 'ASC'],   // Par défaut : Prochainement (date croissante)
        };

        // 3. On récupère les événements triés
        $events = $eventRepository->findBy([], $orderBy);

        return $this->render('home/index.html.twig', [
            'events' => $events,
            'currentSort' => $sort, // On passe la variable pour savoir quel bouton allumer
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