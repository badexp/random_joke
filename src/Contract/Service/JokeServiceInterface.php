<?php


namespace App\Contract\Service;


use App\Model\Joke;

interface JokeServiceInterface
{
    public function getRandom(string $category = null) : Joke;
    public function getCategories() : array;
}