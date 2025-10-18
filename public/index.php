<?php

//Import des dependances
include '../vendor/autoload.php';
//Chargement des fichiers d'environnement

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, "../.env");
$dotenv->load();

//demarrage la session
session_start();
//$grants = $_SESSION["grants"] ?? ["PUBLIC_ROLE"];

use App\Service\Logger;
use App\Service\Logging\LoggerInterface;
use Mithridatem\Routing\Router;
use Mithridatem\Routing\Auth\ArrayGrantChecker;
use Mithridatem\Routing\Exception\RouteNotFoundException;
use Mithridatem\Routing\Exception\UnauthorizedException;

$router = new Router();
$router->setGrantChecker(new ArrayGrantChecker($_SESSION["grants"] ?? ["PUBLIC_ROLE"]));

/** @var LoggerInterface $logger */
$logger = Logger::createDefault();
$user   = $_SESSION['user']['username'] ?? ($_SESSION['username'] ?? null);
$logger->logRequest();

// Declaration des routes
$router->mapController('GET', '/', \App\Controller\HomeController::class, 'index');

// Dispatch central avec gestion d'erreurs
try {
    $router->dispatch();
} catch (UnauthorizedException $e) {
    $logger->warning('Unauthorized: ' . $e->getMessage(), $user);
    http_response_code(403);
    echo 'Acces refuse';
} catch (RouteNotFoundException $e) {
    $logger->warning('Route not found: ' . $e->getMessage(), $user);
    http_response_code(404);
    echo 'Page non trouvee';
} catch (\Throwable $e) {
    $logger->error('Unhandled error: ' . $e->getMessage(), $user);
    http_response_code(500);
    echo 'Erreur interne du serveur';
}
