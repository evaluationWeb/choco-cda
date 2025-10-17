<?php

//Import des dépendances
include '../vendor/autoload.php';
//Chargement des fichiers d'environnement

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->required(["DATABASE_HOST", "DATABASE_NAME", "DATABASE_USERNAME", "DATABASE_PASSWORD"]);
$dotenv->load();

//démarrage la session
session_start();
//$grants = $_SESSION["grants"] ?? ["PUBLIC_ROLE"];

//Router
use Mithridatem\Routing\Router;
use Mithridatem\Routing\Route;
use Mithridatem\Routing\RouteCollection;
use Mithridatem\Routing\Auth\ArrayGrantChecker;

$router = new Router();
$router->setGrantChecker(new ArrayGrantChecker($_SESSION["grants"] ?? ["PUBLIC_ROLE"]));
