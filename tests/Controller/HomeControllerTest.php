<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testIndex():void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('li', 'A propos de We Movies');
        $this->assertSelectorExists('input#search');
        $this->assertSelectorExists('div.col-md-4');
        $this->assertSelectorExists('div.col-md-8');
    }
}
