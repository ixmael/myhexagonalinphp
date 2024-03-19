<?php

namespace CarlosLopez\Hexagonal\Core\Domain;

interface ExamRepositoryInterface
{
    public function getExamById($id);

    public function getQuestionByExamAndId($exam, $questionId);

    public function updateQuestion($question, $newQuestion);
}
