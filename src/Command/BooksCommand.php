<?php

namespace App\Command;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BooksCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
        ->setName('books:all')
        ->setDescription('Get all books')
        ->setHelp('This command shows you all books...')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Books list',
            '============',
            '',
        ]);
        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();
        $booksRepo = $em->getRepository(Book::class);
        $books = $booksRepo->findAll();

        $output->writeln($books);
    }
}