<?php

namespace Apps\Web;

use \Slim\App;

use function Apps\Web\Handlers\Exam\GetExamByIDHandler;

require_once('Handlers/Exam/getExamById.php');

function AddWeb(App $app, $services)
{
    // Setup the template engine
    $container = $app->getContainer();
    $container['view'] = function ($container) use ($services) {
        $view = new Twig(__DIR__ . '/Templates', [
            // 'cache' => __DIR__ . '/var/cache',
            'cache' => null, // this not generate the cache files
        ]);

        // Global variables
        $view->getEnvironment()->addGlobal('environment', $services->environment);

        // Instantiate and add Slim specific extension
        $router = $container->get('router');
        $uri = Uri::createFromEnvironment(new Environment($_SERVER));
        $view->addExtension(new TwigExtension($router, $uri));

        return $view;
    };

    // Routes
    $app->group('', function (App $app) use ($services) {
        //
        $app->get('/examen/{examid}', GetExamByIDHandler($services));

        //
        $app->get('/', function (Request $request, Response $response, array $args) {
            return $this->view->render($response, 'home.twig');
        });
    });
}