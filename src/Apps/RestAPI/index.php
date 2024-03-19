<?php

namespace App\RestAPI;

use \Slim\App;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use function Apps\RestAPI\Handlers\Exam\UpdateQuestionHandler;

require_once(__DIR__ . '/Handlers/Exam/UpdateQuestionHandler.php');

function SetRestAPI(App $app, $services)
{
    $app->group('/api/v1', function (App $app) use ($services) {
        //
        $app->put('/examen/{examid}/pregunta/{questionid}', UpdateQuestionHandler($services));

        //
        $app->get('/ping', function (Request $request, Response $response) {
            $data = [
                'status' => 'ok',
            ];

            return $response
                ->withJson($data);
        });
    });
}
