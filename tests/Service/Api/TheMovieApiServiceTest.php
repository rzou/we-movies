<?php

namespace App\Tests\Api;

use App\Service\Api\TheMovieApiService;
use App\Service\Api\TheMovieApi;
use PHPUnit\Framework\TestCase;

class TheMovieApiServiceTest extends TestCase
{
    private TheMovieApiService $theMovieApiService;
    private TheMovieApi $theMovieApi;

    public function setUp(): void
    {
        $this->theMovieApi = $this->createMock(TheMovieApi::class);
        $this->theMovieApiService = new TheMovieApiService($this->theMovieApi);
    }

    public function testGetGenres(): void
    {
        $genres = [
            ['id' => 1, 'name' => 'Action'],
            ['id' => 2, 'name' => 'Aventure']
        ];
        $this->theMovieApi->expects($this->once())
            ->method('getData')
            ->willReturn(['genres' => $genres]);

        $data = $this->theMovieApiService->getGenres();

        $this->assertEquals($genres, $data);
    }

    public function testGetMoviesWithoutFilter(): void
    {
        $movies = $this->getMoviesData();
        $this->theMovieApi->expects($this->once())
            ->method('getData')
            ->willReturn(['results' => $movies]);

        $data = $this->theMovieApiService->getMovies();

        $this->assertEquals($movies, $data);
    }

    public function testGetMoviesWithFilter(): void
    {
        $genreIds = [1];
        $movies = $this->getMoviesData();
        $this->theMovieApi->expects($this->once())
            ->method('getData')
            ->willReturn(['results' => $movies]);

        $data = $this->theMovieApiService->getMovies($genreIds);
        $selectedMovies = array_slice($movies, 0, 1);

        $this->assertEquals($selectedMovies, $data);
    }
    private function getMoviesData(): array
    {
        return [
            ['id' => 1, 'genre_ids' => [1], 'title' => 'Movie 1', 'release_date' => '2021-07-22'],
            ['id' => 2, 'genre_ids' => [2], 'title' => 'Movie 2', 'release_date' => '2018-04-15'],
        ];
    }
}