<?php

namespace CarlosLopez\Hexagonal\Core\Domain\Exam;

class Exam
{
    private $id = null;

    private $expiresAt = null;

    public function __construct()
    {

    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = new Date($expiresAt);

        return $this;
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }
}
