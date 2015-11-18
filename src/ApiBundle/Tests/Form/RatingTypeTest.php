<?php

namespace ApiBundle\Tests\Form;

use ApiBundle\Entity\Article;
use ApiBundle\Entity\Rating;
use ApiBundle\Form\RatingType;

use Symfony\Component\Form\Test\TypeTestCase;

class RatingTypeTest extends TypeTestCase
{
    public function createFormType()
    {
        return new RatingType();
    }

    public function createClass()
    {
        return new Rating();
    }

    public function testSubmitValidData()
    {
        $formData = [
            'email' => 'maciek.wegrecki@gmail.com',
            'value' => 4,
            'article' => new Article()
        ];

        $type = $this->createFormType();
        $form = $this->factory->create($type);

        $object = $this->createClass();
        $object->setEmail($formData['email']);
        $object->setValue($formData['value']);
        $object->setArticle($formData['article']);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}