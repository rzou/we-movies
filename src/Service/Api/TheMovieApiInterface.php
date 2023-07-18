<?php

namespace App\Service\Api;

interface TheMovieApiInterface
{
    public function getData(string $api): array;
}