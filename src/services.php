<?php

function SetupServices()
{
    $environment = 'production';

    // Init the repositories
    $mysqlClient = $webRepositoryClient = new mysqli(
        "host",
        "user",
        "password",
        "database",
        "3306"
    );
    $examRepository = new ExamMySQL($mysqlClient, $environment);
    // You can init another repository implementation
    // $examRepository = new ExamMongo($mongoClient);

    $s3Client = [];
    $examS3Storage = new ExamS3Storage($s3Client);
    $examSepApi = new SepApi('localhost');

    // Init the services
    $examService = new ExamService(
        $examRepository,
        $examS3Storage,
        $examSepApi,
        $environment);

    $services = new stdClass();

    $services->environment = $environment;
    $services->exam = $examService;

    return $services;
}
