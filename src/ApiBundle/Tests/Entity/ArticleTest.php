<?php

namespace ApiBundle\Tests\Entity;

use ApiBundle\Entity\Answer;
use ApiBundle\Entity\Article;
use ApiBundle\Entity\Rating;
use Symfony\Component\Validator\Constraints\DateTime;

class ArticleTest extends \PHPUnit_Framework_TestCase
{
    public function createClass()
    {
        return new Article();
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

    public function testRatings()
    {
        $object = $this->createClass();
        $this->assertEmpty($object->getRatings());

        $object->addRating(new Rating());
        $object->addRating(new Rating());
        $this->assertCount(2, $object->getRatings());
    }

    public function testAnswers()
    {
        $object = $this->createClass();
        $this->assertEmpty($object->getAnswers());

        $object->addAnswer(new Answer());
        $object->addAnswer(new Answer());
        $this->assertCount(2, $object->getAnswers());
    }
}
 