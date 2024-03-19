<?php

namespace CarlosLopez\Hexagonal\Core\Domain\User;

class User
{
    private $id = null;

    public function __construct()
    {

    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
