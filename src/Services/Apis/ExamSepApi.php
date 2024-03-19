<?php

use CarlosLopez\Hexagonal\Core\Domain\Exam;
use CarlosLopez\Hexagonal\Core\Domain\Exam\ExamSepApiInterface;

class SepApi implements ExamSepApiInterface
{
    private $host = null;

    private $environment = 'production';

    public function __construct($host, $environment)
    {
        $this->host = $host;

        $this->environment = $environment;
    }

    public function isCertifiedCorrect($certifyId)
    {
        // check if the certified is correct
        // curl to $this->host
    }
}
