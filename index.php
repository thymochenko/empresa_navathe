<?php

require_once __DIR__ . '/../vendor/autoload.php';
#require_once __DIR__ . '/../vendor/controllers/PetController.php';
#require_once __DIR__ . '/../vendor/models/Pet.php';
#require_once __DIR__ . '/../vendor/models/PetRepository.php';
#require_once __DIR__ . '/../vendor/forms/PetType.php';
#require_once __DIR__ . '/../vendor/tests/PetTest.php';

use Silex\Provider\FormServiceProvider;


$app = new Silex\Application();
$app->register(new FormServiceProvider());

$app['debug'] = true;

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'dbname' => 'Empresa',
        'user' => 'root',
        'password' => '01011986',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ],
]);

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/../vendor/views',
]);
$app->register(new Silex\Provider\TranslationServiceProvider(), [
    'translator.messages' => [],
]);
$app->register(new Silex\Provider\ValidatorServiceProvider());

$app['domain.repository'] = $app->share(function ($app) {
     $repository['pet'] = new DomainLayer\Repository\PetRepository($app['db']);
     return $repository;
});

$app->match('pet/create', 'Menagerie\\PetController::createForm');
$app->match('pet/age/death/all', 'Menagerie\\PetController::executeDeathAge');
$app->match('pet/birthday/all/{month}', 'Menagerie\\PetController::executeBirthdaysByMonth');
$app->run();