<?php

use CarlosLopez\Hexagonal\Core\Domain\Exam;
use CarlosLopez\Hexagonal\Core\Domain\ExamRepository;

class ExamMongo implements ExamRepository
{
    private $client = null;

    private $environment = 'production';

    public function __construct($mongoClient, $environment)
    {
        $this->client = $mongoClient;

        $this->environment = $environment;
    }

    public function getExamById($id)
    {
        $collection = $this->client->demo->exams;
        $result = $collection->find( [ 'id' => $id ] );

        $exam = null;
        foreach ($result as $examDocument) {
            $exam = (new Exam())
                ->setId($examDocument['id'])
                ->setExpiresAt($examDocument['expires_at']);
        }

        return $exam;
    }

    public function getQuestionByExamAndId($exam, $questionId)
    {
        $question = [];

        return $question;
    }
}
