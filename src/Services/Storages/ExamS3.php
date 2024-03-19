<?php

use CarlosLopez\Hexagonal\Core\Domain\Exam;
use CarlosLopez\Hexagonal\Core\Domain\Exam\ExamStorageInterface;

class ExamS3Storage implements ExamStorageInterface
{
    private $client = null;

    private $environment = 'production';

    public function __construct($s3Client, $environment)
    {
        $this->client = $s3Client;

        $this->environment = $environment;
    }

    public function upload($document)
    {
        // code to upload to S3
    }
}
