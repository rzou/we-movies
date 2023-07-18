<?php

namespace App\Tests\Service\Video;

use App\Service\Video\VideoService;
use App\Service\Video\Youtube;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class VideoServiceTest extends KernelTestCase
{
    /**
     * @dataProvider videoProvider
     */
    public function testReturnUrl(array $videoData, string $expectedUrl)
    {
        $videoService = new VideoService(new Youtube());
        $this->assertSame($expectedUrl, $videoService->getURLVideo($videoData));
    }

    public function videoProvider(): array
    {
        return [
            [['key' => 'video_id', 'site' => 'YouTube'], 'https://www.youtube.com/embed/video_id'],
            [['key' => 'video_id', 'site' => 'spotify'], ''],
            [['key' => 'video_id', 'site' => ''], ''],
        ];
    }
}