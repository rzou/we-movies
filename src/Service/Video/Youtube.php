<?php

namespace App\Service\Video;

class Youtube implements VideoInterface
{
    public const PROVIDER_NAME = 'YouTube';
    public const BASE_URL = 'https://www.youtube.com/embed/';

    public function getURLVideo(array $videoData): string
    {
        if (empty($videoData['key'])) {
            return '';
        }

        return self::BASE_URL . $videoData['key'];
    }

    public function getProviderName(): string
    {
        return self::PROVIDER_NAME;
    }
}
