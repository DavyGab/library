<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/books", name="api_book_index", methods="GET")
     */
    public function indexAction(Request $request)
    {
        $before_date = $request->query->get('before_date');
        $after_date = $request->query->get('after_date');
        $nationality = $request->query->get('nationality');

        $repository = $this->getDoctrine()->getRepository(Book::class);
        $book = $repository->findByDateAndNationality($before_date, $after_date, $nationality);

        $serializer = SerializerBuilder::create()->build();
        $jsonObject = $serializer->serialize($book, 'json');

        return $this->render('api.html.twig', [
            'json_response' => $jsonObject,
        ]);
    }
}
