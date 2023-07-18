<?php

namespace App\Controller;

use App\Service\Api\TheMovieApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TheMovieApiService $theMovieApiService): Response
    {
        $video = [];
        $movies = $theMovieApiService->getMovies();
        if (!empty(current(array_column($movies,'id'))))
            $video = $theMovieApiService->getVideosMovie(current(array_column($movies,'id')));

        return $this->render('home/index.html.twig', [
            'genres' => $theMovieApiService->getGenres(),
            'movies' => $movies,
            'video' => $video,
        ]);
    }
}