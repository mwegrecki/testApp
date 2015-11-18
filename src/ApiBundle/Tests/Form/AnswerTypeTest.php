<?php

namespace ApiBundle\Tests\Form;

use ApiBundle\Entity\Answer;
use ApiBundle\Entity\Article;
use ApiBundle\Form\AnswerType;

use Symfony\Component\Form\Test\TypeTestCase;

class AnswerTypeTest extends TypeTestCase
{
    public function createFormType()
    {
        return new AnswerType();
    }

    public function createClass()
    {
        return new Answer();
    }

    public function testSubmitValidData()
    {
        $formData = [
            'email' => 'maciek.wegrecki@gmail.com',
            'content' => 'test content',
            'article' => new Article()
        ];

        $type = $this->createFormType();
        $form = $this->factory->create($type);

        $object = $this->createClass();
        $object->setEmail($formData['email']);
        $object->setContent($formData['content']);
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