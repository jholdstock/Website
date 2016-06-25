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
// ROUTING
//
$app->get('/', function () use ($app) {
    return $app['twig']->render('construction.twig');
})->bind("home");

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