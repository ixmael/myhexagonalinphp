<?php

namespace CarlosLopez\Hexagonal\Core\Domain;

interface ExamServiceInterface
{
    public function getExamById($id);

    public function updateQuestionExam($examId, $questionId, $newQuestion);

    public function checkUserIsAvailableToRespondExam($userId, $certify);
}
