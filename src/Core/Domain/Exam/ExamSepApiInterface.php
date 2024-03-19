<?php

namespace CarlosLopez\Hexagonal\Core\Domain;

interface ExamSepApiInterface
{
    public function isCertifiedCorrect($certifyId);
}
