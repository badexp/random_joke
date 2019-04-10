<?php


namespace App\Contract\Service;


use App\Model\Joke;

/**
 * Interface JokeServiceInterface
 * @package App\Contract\Service
 */
interface JokeServiceInterface
{
    public function getRandom(string $category = null) : Joke;
    public function getCategories() : array;
}