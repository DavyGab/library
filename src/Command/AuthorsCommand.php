<?php

namespace App\Command;

use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AuthorsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
        ->setName('authors:all')
        ->setDescription('Get all authors')
        ->setHelp('This command shows you all authors...')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Authors list',
            '============',
            '',
        ]);
        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();
        $authorsRepo = $em->getRepository(Author::class);
        $authors = $authorsRepo->findAll();

        $output->writeln($authors);
    }
}