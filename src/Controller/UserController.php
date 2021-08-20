<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route(name="users", path="/users", methods={"GET"})
     */
    public function users()
    {
        $users = $this->repository->findAll();
        $mockDTO = [];

        foreach ($users as $user) {
            $mockDTO[] = $user->getEmail();
        }
        return new JsonResponse([$mockDTO]);
    }
}
