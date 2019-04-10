<?php


namespace App\Service;

use App\Contract\Service\JokeServiceInterface;
use App\Model\Joke;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;

/**
 * Class ICNDBService
 * Simple implementation for http://www.icndb.com/api/
 * @package App\Service
 */
class ICNDBService implements JokeServiceInterface
{
    private const BASE_URL = 'api.icndb.com';

    private const METHOD_RANDOM = '/jokes/random';
    private const METHOD_CATEGORIES = '/categories';

    /**
     * Gets random Joke
     * @param string|null $category
     * @return Joke
     */
    public function getRandom(string $category = null) : Joke
    {
        $params = $category !== null ? [
            'limitTo' => [ $category ]
        ] : [];

        $httpClient = new Client();
        $httpResponse = $httpClient->get(
            (new Uri())
                ->withHost(self::BASE_URL)
                ->withPath(self::METHOD_RANDOM)
                ->withQuery(http_build_query($params))
        );
        $response = \GuzzleHttp\json_decode($httpResponse->getBody());
        return $httpResponse->getStatusCode() === 200 ?
            new Joke($response->value->joke) : new Joke('Ha-ha it\'s failed to get your joke! :D');
    }

    public function getCategories() : array
    {
        $httpClient = new Client();
        $httpResponse = $httpClient->get(
            (new Uri())
                ->withHost(self::BASE_URL)
                ->withPath(self::METHOD_CATEGORIES)
        );
        $response = \GuzzleHttp\json_decode($httpResponse->getBody());
        return $httpResponse->getStatusCode() === 200 ? $response-> value : [];
    }
}