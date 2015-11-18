<?php

namespace ApiBundle\Tests\Entity;

use ApiBundle\Entity\Rating;
use ApiBundle\Entity\Article;
use Symfony\Component\Validator\Constraints\DateTime;

class RatingTest extends \PHPUnit_Framework_TestCase
{
    public function createClass()
    {
        return new Rating();
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

    public function testValue()
    {
        $object = $this->createClass();
        $this->assertNull($object->getValue());

        $object->setValue(2);
        $this->assertEquals(2, $object->getValue());
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
 