<?php

use CarlosLopez\Hexagonal\Core\Domain\Exam;
use CarlosLopez\Hexagonal\Core\Domain\Exam\ExamStorageInterface;

class ExamAzureStorage implements ExamStorageInterface
{
    private $client = null;

    private $environment = 'production';

    public function __construct($azureClient, $environment)
    {
        $this->client = $azureClient;

        $this->environment = $environment;
    }

    public function upload($document)
    {
        // code to upload to azure
    }
}
