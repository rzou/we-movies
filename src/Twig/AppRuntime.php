<?php

namespace App\Twig;

use App\Service\Video\VideoService;
use Twig\Extension\RuntimeExtensionInterface;

class AppRuntime implements RuntimeExtensionInterface
{
    public function __construct(private VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    public function getURLVideo(array $videoData): string
    {
        return $this->videoService->getURLVideo($videoData);
    }
}