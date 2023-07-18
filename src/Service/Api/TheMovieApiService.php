<?php

namespace App\Service\Api;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class TheMovieApiService
{
    public function __construct(protected TheMovieApiInterface $theMovieApi)
    {
        $this->theMovieApi = $theMovieApi;
    }

    public function getGenres(): array
    {
        $list =  $this->theMovieApi->getData('genre/movie/list');
        return $list['genres'] ?? [];
    }

    public function getMovies(?array $genreIds = []): array
    {
        $list =  $this->theMovieApi->getData('movie/top_rated');
        $movies = $list['results'] ?? [];

        if ($genreIds) {
            $selectedMovies = [];
            foreach($movies as $movie) {
                if (array_intersect($movie['genre_ids'], $genreIds)) {
                    $selectedMovies[] = $movie;
                }
            }

            return $selectedMovies;
        }

        return $movies;
    }

    public function getDetailMovie(int $idMovie): array
    {
        return $this->theMovieApi->getData('movie/' . $idMovie) ?? [];
    }

    public function getVideosMovie(int $idMovie): array
    {
        $list =  $this->theMovieApi->getData('movie/' . $idMovie . '/videos') ?? [];

        return $list['results'][0] ?? [];
    }
}
