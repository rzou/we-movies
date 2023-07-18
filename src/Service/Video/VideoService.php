<?php

namespace App\Service\Video;

class VideoService implements VideoInterface
{
    public const PROVIDER_NAME = 'VideoService';

    private $providers;

    public function __construct(VideoInterface ...$providers)
    {
        $this->providers = $providers;
    }

    public function getURLVideo(array $videoData): string
    {
        if (!empty($videoData['site'])) {
            foreach ($this->providers as $provider) {
                if ($provider->getProviderName() === $videoData['site']) {
                    return $provider->getURLVideo($videoData);
                }
            }
        }
        return '';
    }

    public function getProviderName(): string
    {
        return self::PROVIDER_NAME;
    }
}
