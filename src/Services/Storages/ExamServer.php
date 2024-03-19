<?php

use CarlosLopez\Hexagonal\Core\Domain\Exam;
use CarlosLopez\Hexagonal\Core\Domain\Exam\ExamStorageInterface;

class ExamServerStorage implements ExamStorageInterface
{
    $serverPath = '/home/tuusuario/exam';

    private $environment = 'production';

    public function __construct($environment)
    {
        $this->environment = $environment;
    }

    public function upload($document)
    {
        // copy the file to a dir $serverPath in the server
    }
}
