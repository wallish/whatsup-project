<?php

namespace Knnf\WhatsupBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/index');
    }

    public function testArticle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/article');
    }

    public function testUser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user');
    }

    public function testCategory()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/category');
    }

    public function testMedia()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/media');
    }

    public function testEvent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/event');
    }

}
