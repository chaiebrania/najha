<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateStaffCommand extends Command
{
    protected static $defaultName = 'app:create-staff';
    private $userPasswordEncoder;
    private $entityManager;

    public function __construct(
        UserPasswordEncoderInterface $userPasswordEncoder,
        EntityManagerInterface $entityManager,
        string $name = null)
    {
        parent::__construct($name);
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
        ->setDescription('Create staff member account')
        ->addArgument('email', InputArgument::REQUIRED, 'Enter an email address')
        ->addArgument('password', InputArgument::REQUIRED, 'Enter a password')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $staff = new User();
        $staff
            ->setEmail($email)
            ->setPassword(
                $this->userPasswordEncoder->encodePassword(
                    $staff,
                    $password
                )
            );

        $this->entityManager->persist($staff);
        $this->entityManager->flush();

        $io->success('Staff account created successfully.');

        return 0;
    }
}
