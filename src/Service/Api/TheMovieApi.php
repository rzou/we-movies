<?php

namespace App\Service\Api;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class TheMovieApi implements TheMovieApiInterface
{
    const API_URL = 'https://api.themoviedb.org/3/';

    public function __construct(private string $apiKey, private HttpClientInterface $client)

    {
        $this->apiKey = $apiKey;
        $this->client = $client;
    }

    public function getData(string $api): array
    {
        try {
            $response = $this->client->request(
                'GET',
                $this->getUrl($api)
            );
            if ($response->getStatusCode() != 200) {
                return [];
            }
            return $response->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getUrl(string $api): string
    {
        return self::API_URL . $api . '?api_key=' . $this->apiKey . '&language=fr-FR';
    }

}