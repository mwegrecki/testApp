<?php

namespace ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class AnswerControllerTest extends WebTestCase
{
    public function testInvalidMailCreate()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/answer/', ['email'=>'masd']);

        $response = $client->getResponse();

        $this->assertJsonResponse($response, 400);
        $this->assertEquals('The email \'"masd"\' is not a valid email.', json_decode($response->getContent())->email);
    }

    public function testEmptyMailCreate()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/answer/', ['email'=>'masd']);

        $response = $client->getResponse();

        $this->assertJsonResponse($response, 400);
        $this->assertEquals('The email \'"masd"\' is not a valid email.', json_decode($response->getContent())->email);
        $this->assertEquals('This value should not be blank.', json_decode($response->getContent())->content);
        $this->assertEquals('This value should not be blank.', json_decode($response->getContent())->article);
    }

    public function testCreateInvalidArticle()
    {
        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/api/answer/',
            [
                'email' => 'maciek.wegrecki@gmail.com',
                'content' => 'test content',
                'article' => -1
            ]
        );

        $response = $client->getResponse();

        $this->assertJsonResponse($response, 400);
        $this->assertEquals('This value is not valid.', json_decode($response->getContent())->article);
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