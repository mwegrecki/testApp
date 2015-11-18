<?php

namespace ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class ArticleControllerTest extends WebTestCase
{
    public function testInvalidMailCreate()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/article/', ['email'=>'masd']);

        $response = $client->getResponse();

        $this->assertJsonResponse($response, 400);
        $this->assertEquals('The email \'"masd"\' is not a valid email.', json_decode($response->getContent())->email);
    }

    public function testEmptyMailCreate()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/article/', ['email'=>'masd']);

        $response = $client->getResponse();

        $this->assertJsonResponse($response, 400);
        $this->assertEquals('The email \'"masd"\' is not a valid email.', json_decode($response->getContent())->email);
        $this->assertEquals('This value should not be blank.', json_decode($response->getContent())->content);
        $this->assertEquals('This value should not be blank.', json_decode($response->getContent())->title);
    }

    protected function assertJsonResponse($response, $statusCode = 200)
    {
        $this->assertEquals(
            $statusCode, $response->getStatusCode(),
            $response->getContent()
        );

        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
    }
}