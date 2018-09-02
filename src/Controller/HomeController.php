<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods="GET")
     */
    public function home(BookRepository $bookRepository): Response
    {
        return $this->render('home.html.twig', ['books' => $bookRepository->findAll()]);
    }
}
