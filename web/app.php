<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\TwigServiceProvider;
use Silex\Application;
use Silex\Provider\UrlGeneratorServiceProvider;

$app = new Application();

//
// REGISTER SERVICES
//
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app->register(new UrlGeneratorServiceProvider());

//
// CONTEXT
//
$context = array(
    "year" => date("Y")
);

//
// ROUTING
//
$app->get('/', function () use ($app, $context) {
    return $app['twig']->render('construction.twig', $context);
})->bind("home");

$app->get('/projects', function () use ($app, $context) {
    return $app['twig']->render('projects/projects.twig', $context);
})->bind("projects");

$app->get('/hambaguette', function () use ($app, $context) {
    return $app['twig']->render('projects/hambaguette.twig', $context);
})->bind("hambaguette");

$app->get('/contact', function () use ($app, $context) {
    return $app['twig']->render('contact.twig', $context);
})->bind("contact");

$app->get('/about', function () use ($app, $context) {
    return $app['twig']->render('about.twig', $context);
})->bind("about");

//
// ERROR HANDLER
//
$app->error(function (\Exception $e, $code) {
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = 'Something went terribly wrong.';
            var_dump($e);
    }
    return new Response($message);
});



$app->run();