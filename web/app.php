<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/TflPage.php';

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
    "year"    => date("Y")
);

//
// ROUTING
//

$app->get('/ip', function (Request $request) use ($app, $context) {
    $context = array(
        "year"    => file_get_contents("deluge_ip")
    );

    return $app['twig']->render('projects/hambaguette.twig', $context);
})->bind("ip");

$app->get('/deluge_ip', function (Request $request) use ($app, $context) {
      
    $params = $request->query->all();
    $ip = $params["ip"];
    file_put_contents("deluge_ip", $ip);
    
    return $app['twig']->render('construction.twig', $context);
})->bind("deluge_ip");

$app->get('/tfl', function (Request $request) use ($app, $context) {
    
    $tfl = new TflPage();
    $params = $request->query->all();
    $journeys = $tfl->work($params["password"]);
    $context = array_merge($context, array("journeys" => $journeys));
    
    return $app['twig']->render('tfl.twig', $context);
})->bind("tfl");


$app->get('/', function () use ($app, $context) {
    return $app['twig']->render('construction.twig', $context);
})->bind("home");

$app->get('/cv', function () use ($app, $context) {
    return $app['twig']->render('cv.twig', $context);
})->bind("cv");

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