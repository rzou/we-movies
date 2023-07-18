<?php

namespace App\Controller;

use App\Service\Api\TheMovieApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private function isXMLHttpRequest(Request $request): void
    {
        if (!$request->isXMLHttpRequest())
            throw new \Exception('Erreur');
    }

    #[Route('/ajax-search-movies',name: "app_ajax_search_movies", options:['expose' =>true],methods: ['POST'])]
    public function searchMovies(Request $request, TheMovieApiService $theMovieApiService): Response
    {
        $this->isXMLHttpRequest($request);
        $resSearch = [];
        $movies = $theMovieApiService->getMovies();
        $title = $request->request->get('title');
        foreach ($movies as $movie) {
            if (stripos($movie['title'], $title) !== false) {
                $resSearch[] = $movie;
            }
        }

        $data = $this->render('movies/_search_movies.html.twig', [
            'movies' => $resSearch,
        ]);

        return $this->json(['isValid' => true, 'content' => $data->getContent()], 200);
    }

    #[Route('/ajax-movies-by-genres',name: "app_ajax_movies_by_genres", options:['expose' =>true],methods: ['POST'])]
    public function moviesByGenres(Request $request, TheMovieApiService $theMovieApiService): Response
    {
        $this->isXMLHttpRequest($request);
        $moviesIds = $request->request->get('genresIds');
        $movies = $theMovieApiService->getMovies($moviesIds);

        $data = $this->render('movies/_movies_by_genres.html.twig', [
            'movies' => $movies
        ]);

        return $this->json([
            'isValid' => true,
            'content' => $data->getContent(),
        ], 200);
    }

    #[Route('/ajax-detail-movie/{id}',name: "app_ajax_detail_movie", options:['expose' =>true],methods: ['GET'])]
    public function detail(int $id, Request $request, TheMovieApiService $theMovieApiService): Response
    {
        $this->isXMLHttpRequest($request);
        $data = $this->render('movies/_detail.html.twig', [
            'video' => $theMovieApiService->getVideosMovie($id),
            'movie' => $theMovieApiService->getDetailMovie($id),
        ]);

        return $this->json(['isValid' => true,
            'content' => $data->getContent()],
            200);
    }

    #[Route('/show/{id}',name: "app_show_movie")]
    public function show(int $id, TheMovieApiService $theMovieApiService): Response
    {
        return $this->render('movies/show.html.twig', [
            'video' => $theMovieApiService->getVideosMovie($id),
            'movie' => $theMovieApiService->getDetailMovie($id),
        ]);
    }
}
