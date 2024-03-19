<?php

use CarlosLopez\Hexagonal\Core\Domain\User\UserRepositoryInterface;
use CarlosLopez\Hexagonal\Core\Domain\Exam\ExamServiceInterface;
use CarlosLopez\Hexagonal\Core\Domain\Exam\ExamRepositoryInterface;
use CarlosLopez\Hexagonal\Core\Domain\Exam\ExamStorageInterface;
use CarlosLopez\Hexagonal\Core\Domain\Exam\ExamSepApiInterface;

class ExamService implements ExamServiceInterface
{
    private $userRepository = null;
    private $examRepository = null;
    private $examStorage = null;
    private $examSepApi = null;

    private $environment = 'production';

    public function __construct(
        ExamRepositoryInterface $examRepository,
        UserRepositoryInterface $userRepository,
        ExamStorageInterface $examStorage,
        ExamSepApiInterface $examSepApi,
        $environment
    )
    {
        $this->examRepository = $examRepository;
        $this->userRepository = $userRepository;
        $this->examStorage = $examStorage;
        $this->examSepApi = $examSepApi;

        $this->environment = $environment;
    }

    public function getExamById($id)
    {
        // Validate if the ID is correct
        if ($id > 0)
        {
            throw new Exception('not valid id');
        }

        // Get the exam
        $exam = $this->examRepository->getExamById($id);

        // some validation of the exam
        $today = new Date();
        if ($exam->getExpiresAt() > $today)
        {
            throw new Exception('the exam is expired');
        }

        return $exam;
    }

    public function updateQuestionExam($examId, $questionId, $newQuestion)
    {
        // Get the exam
        $exam = $this->examRepository->getExamById($examId);
        if (!$exam)
        {
            throw new Exception('there is not a valid exam');
        }

        $question = $this->examRepository->getQuestionByExamAndId($exam, $questionId);
        if (!$question)
        {
            throw new Exception('there is not a valid question');
        }

        // Update
        $wasUpdated = $this->examRepository->updateQuestion($question, $newQuestion);

        return $wasUpdated;
    }

    public function checkUserIsAvailableToRespondExam($userId, $certify)
    {
        // Verificar si existe el usuario
        $user = $this->userService->getById($userId);
        if (!isset($user))
        {
            // no existe el usuario
        }


        // Subir archivo al gestor de archivos
        $wasUploaded = $this->examStorage->upload($certify);
        if (!$wasUploaded)
        {
            // No se subió el archivo, mandar un error
        }


        // Verificar si el certificado es válido
        $isCertifyValid = $this->examSepApi->isValid($certify);
        if (!$isCertifyValid)
        {
            // el certificado no es válido, rechazar todo el proceso
        }

        // El usuario sí tiene la posibilidad de responder el examen
        return true;
    }
}
