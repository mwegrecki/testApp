<?php

namespace ApiBundle\Tests\Form;

use ApiBundle\Entity\Article;
use ApiBundle\Form\ArticleType;

use Symfony\Component\Form\Test\TypeTestCase;

class ArticleTypeTest extends TypeTestCase
{
    public function createFormType()
    {
        return new ArticleType();
    }

    public function createClass()
    {
        return new Article();
    }

    public function testSubmitValidData()
    {
        $formData = [
            'email' => 'maciek.wegrecki@gmail.com',
            'content' => 'test content',
        ];

        $type = $this->createFormType();
        $form = $this->factory->create($type);

        $object = $this->createClass();
        $object->setEmail($formData['email']);
        $object->setContent($formData['content']);

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