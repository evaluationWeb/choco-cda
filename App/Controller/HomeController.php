<?php

namespace App\Controller;

use App\Service\Logger;
use App\Service\Logging\LoggerInterface;

class HomeController extends AbstractController
{
    private LoggerInterface $logger;

    public function __construct(?LoggerInterface $logger = null)
    {
        $this->logger = $logger ?? new Logger();
    }

    public function index(): void
    {
        $username = $_SESSION['user']['username'] ?? $_SESSION['username'] ?? null;
        $this->logger->info('Affichage de la page d\'accueil', $username);
        $this->render('templates/home', [
            'title' => 'Accueil - Chocoblast',
            'user' => $username ?? 'anonymous',
        ]);
    }
}
