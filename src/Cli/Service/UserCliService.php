<?php

namespace App\Cli\Service;

use App\Entity\User;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use App\ValueObject\Auth\HashedPassword;
use App\ValueObject\Auth\Email;
use App\ValueObject\Role;
use Doctrine\Common\Collections\ArrayCollection;

class UserCliService
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(RoleRepository $repository, UserRepository $userRepository)
    {
        $this->roleRepository = $repository;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Assert\AssertionFailedException
     */
    public function create(string $email, string $name, string $password, string $role)
    {
        $roleValue = Role::fromString($role);
        $roleObject = $this->roleRepository->oneByName($roleValue);

        $user = new User();
        $user->setEmail((Email::fromString($email))->toString());
        $user->setPassword((HashedPassword::encode($password))->toString());
        $user->addRole($roleObject);
        $user->setName($name);

        $this->userRepository->add($user);

        return $user;
    }
}
