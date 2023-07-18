<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_fully_image_url_movies', [$this, 'getFullyImageURLMovies']),
            new TwigFunction('get_url_video', [AppRuntime::class, 'getURLVideo']),
        ];
    }

    public function getFullyImageURLMovies(string $imagePath, string $fileSize): string
    {
        return $_ENV['THE_MOVIES_IMAGE_BASE_URL'] . $fileSize . '/' . $imagePath;
    }
}
