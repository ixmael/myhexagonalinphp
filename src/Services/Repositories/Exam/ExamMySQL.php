<?php

use CarlosLopez\Hexagonal\Core\Domain\Exam;
use CarlosLopez\Hexagonal\Core\Domain\ExamRepository;

class ExamMySQL implements ExamRepository
{
    private $client = null;

    private $environment = 'production';

    public function __construct($mysqlClient, $environment)
    {
        $this->client = $mysqlClient;

        $this->environment = $environment;
    }

    public function getExamById($id)
    {
        $getExamQuery = "
            SELECT
                *
            FROM
                exam
            WHERE
                id = ?
            LIMIT
                1
        ";

        $exam = null;
        if ($getQuery = $this->repositoryClient->prepare($getExamQuery)) {
            $getQuery->bind_param('i', $id);

            if ($getQuery->execute()) {
                $result = $getQuery->get_result();

                if ($row = $result->fetch_assoc()) {
                    $exam = (new Exam())
                        ->setId($row['id'])
                        ->setExpiresAt($row['expires_at']);
                }
            }

            $getQuery->close();
        }

        return $exam;
    }

    public function getQuestionByExamAndId($exam, $questionId)
    {
        $question = [];

        return $question;
    }

    public function updateQuestion($question, $newQuestion)
    {
        $updateQuestionQuery = '
            UPDATE
                exam
            SET
                question = ?
            WHERE
                question_id = ?
        ';

        $wasUpdated = false;
        if ($updateQuery = $this->repositoryClient->prepare($updateQuestionQuery)) {
            $updateQuery->bind_param('is', $question->getId(), $newQuestion);

            if ($updateQuery->execute()) {
                $wasUpdated = true;
            }

            $updateQuery->close();
        }

        return $wasUpdated;
    }
}
