<?php

namespace Apps\Web\Handlers\Exam;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

function GetExamByIDHandler($services)
{
    return function (Request $request, Response $response, $args) use ($services) {
        $exam = $services['exam']->getExamById($args['examid']);

        return $this->view->render($response, 'exam.twig', [
            'exam' => $exam,
        ]);
    };
}