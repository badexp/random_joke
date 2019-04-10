<?php

namespace App\Controller;

use App\Contract\Service\JokeServiceInterface;
use App\Form\RandomJokeType;
use App\Model\Joke;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RandomJokeController extends AbstractController
{
    /**
     * @Route("/", name="random_joke", methods={"GET", "POST"})
     */
    public function index(Request $request, JokeServiceInterface $jokeService, \Swift_Mailer $mailer)
    {
        $jokeCategories = $jokeService->getCategories();

        $randomJokeForm = $this->createForm(RandomJokeType::class, [
            'categories' => $jokeCategories
        ]);
        $randomJokeForm->handleRequest($request);

        if($randomJokeForm->isSubmitted() && $randomJokeForm->isValid())
        {
            $emailRecipient = $randomJokeForm->get('email')->getData();
            $emailSubject = 'Случайная шутка из '.$randomJokeForm->get('category')->getData();

            $jokeService->getRandom()
                ->sendByEmail($mailer, $emailRecipient, $emailSubject)
                ->saveAsFile('/application/var/jokes.txt');
        }

        return $this->render('web/get_random_joke.html.twig', [
            'form_get_joke' => $randomJokeForm->createView()
        ]);
    }
}
