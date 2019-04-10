<?php


namespace App\Service;


use App\Contract\Service\JokeServiceInterface;
use App\Model\Joke;

class ICNDBService implements JokeServiceInterface
{

    public function getRandom(string $category = null) : Joke
    {
        // TODO: Implement getRandom() method.
        return new Joke('Joke sample :D');
    }

    public function getCategories() : array
    {
        // TODO: Implement getCategories() method.
        return ['explicit', 'nerdy'];
    }
}