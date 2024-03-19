<?php

use CarlosLopez\Hexagonal\Core\Domain\User\User;
use CarlosLopez\Hexagonal\Core\Domain\User\UserRepositoryInterface;

class UserMySQL implements UserRepositoryInterface
{
    private $client = null;

    private $environment = 'production';

    public function __construct($mysqlClient, $environment)
    {
        $this->client = $mysqlClient;

        $this->environment = $environment;
    }

    public function getById($id)
    {
        $getExamQuery = "
            SELECT
                *
            FROM
                user
            WHERE
                id = ?
            LIMIT
                1
        ";

        $user = null;
        if ($getQuery = $this->repositoryClient->prepare($getExamQuery)) {
            $getQuery->bind_param('i', $id);

            if ($getQuery->execute()) {
                $result = $getQuery->get_result();

                if ($row = $result->fetch_assoc()) {
                    $user = (new User())
                        ->setId($row['id'])
                        ->setExpiresAt($row['expires_at']);
                }
            }

            $getQuery->close();
        }

        return $user;
    }
}
