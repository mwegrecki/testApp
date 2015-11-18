<?php

namespace ApiBundle\Tests\Entity;

use ApiBundle\Entity\Answer;
use ApiBundle\Entity\Article;
use Symfony\Component\Validator\Constraints\DateTime;

class AnswerTest extends \PHPUnit_Framework_TestCase
{
    public function createClass()
    {
        return new Answer();
    }

    public function testId()
    {
        $object = $this->createClass();
        $this->assertNull($object->getId());
    }

    public function testEmail()
    {
        $object = $this->createClass();
        $this->assertNull($object->getEmail());

        $object->setEmail('maciek.wegrecki@gmail.com');
        $this->assertEquals('maciek.wegrecki@gmail.com', $object->getEmail());
    }

    public function testContent()
    {
        $object = $this->createClass();
        $this->assertNull($object->getContent());

        $object->setContent('test answer');
        $this->assertEquals('test answer', $object->getContent());
    }

    public function testCreatedAt()
    {
        $object = $this->createClass();
        $this->assertNull($object->getCreatedAt());

        $date = new DateTime();
        $object->setCreatedAt($date);
        $this->assertEquals($date, $object->getCreatedAt());
    }

    public function testArticle()
    {
        $object = $this->createClass();
        $this->assertNull($object->getArticle());

        $article = new Article();
        $object->setArticle($article);
        $this->assertEquals($article, $object->getArticle());
    }
}
 