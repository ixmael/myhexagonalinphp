<?php

function UpdateQuestionHandler($services)
{
    return function (Request $request, Response $response, $args) use ($services)
    {
        // Get the arguments
        $examid = $args['examid'];
        $questionid = $args['questionid'];

        // validate request
        if ($examid < 1 || $questionid < 1)
        {
            return $response
                ->withStatus(400)
                ->withJson([
                    'message' => 'the exam or question are not valid',
                ]);
        }

        $newQuestion = $request->getParsedBody();
        // Validate json
        if (!$newQuestion || !isset($newQuestion['question'])) {
            return $response
                ->withStatus(400)
                ->withJson([
                    'message' => 'the question body is empty',
                ]);
        }

        $wasUpdated = $services->exam->updateQuestionExam($examid, $questionid, $newQuestion);
        if (!$wasUpdated)
        {
            return $response
                ->withStatus(500);
        }


        return $response
            ->withStatus(200)
            ->withJson([
                'success' => true,
            ]);
    }
}