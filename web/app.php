<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Response;
use Silex\Provider\TwigServiceProvider;

$app = new Silex\Application();


//
// REGISTER SERVICES
//
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

//
// ROUTING
//
$app->get('/', function () use ($app) {
    return $app['twig']->render('about.twig', array());
})->bind("home");

$app->get('/cv', function () use ($app) {
    return $app['twig']->render('cv.twig', array());
})->bind("cv");

$app->get('/projects', function () use ($app) {
    return $app['twig']->render('projects.twig', array());
})->bind("projects");

$app->get('/contact', function () use ($app) {
    return $app['twig']->render('contact.twig', array());
})->bind("contact");

$app->get('/about', function () use ($app) {
    return $app['twig']->render('about.twig', array());
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