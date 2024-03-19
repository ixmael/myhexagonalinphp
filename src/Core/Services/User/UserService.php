<?php

use CarlosLopez\Hexagonal\Core\Domain\User\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private $userRepository = null;
    private $environment = 'production';

    public function __construct($userRepository, $environment)
    {
        $this->userRepository = $userRepository;

        $this->environment = $environment;
    }

    public function getById($id)
    {
        $user = $this->userRepository->getById($id);
        if (!$user)
        {
            // no existe el usuario
            return null;
        }

        if (!$user->isActive)
        {
            // el usuario está inactivo
            // esto también lo puedes tener desde la base de datos con la consulta
            return null;
        }

        return $user;
    }
}
