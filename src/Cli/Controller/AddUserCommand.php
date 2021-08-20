<?php

namespace App\Cli\Controller;

use App\Cli\Service\UserCliService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddUserCommand extends Command
{

    /**
     * @var UserCliService
     */
    private $service;

    protected function configure()
    {
        $this
            ->setName('app:create-user')
            ->setDescription('create a user')
            ->addArgument('email', InputArgument::REQUIRED, 'user email')
            ->addArgument('name', InputArgument::REQUIRED, 'user name')
            ->addArgument('password', InputArgument::REQUIRED, 'user password')
            ->addArgument('role', InputArgument::REQUIRED, 'user role');

        $this->setHelp('Create a user by giving, email name password and role');
    }

    public function __construct(UserCliService $userCliService)
    {
        parent::__construct();
        $this->service = $userCliService;
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = $this->service->create(
            $email = (string) $input->getArgument('email'),
            $password = (string) $input->getArgument('password'),
            $username = (string) $input->getArgument('name'),
            $role = (string) $input->getArgument('role')
        );

        if (!$user) {
            return 0;
        }

        $output->writeln("<info>$username has been created</info>");

        return 1;
    }
}
