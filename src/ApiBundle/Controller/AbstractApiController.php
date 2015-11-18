<?php
/**
 * Created by PhpStorm.
 * User: maciej
 * Date: 11/17/15
 * Time: 11:33 PM
 */

namespace ApiBundle\Controller;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractApiController
 * @package ApiBundle\Controller
 */
abstract class AbstractApiController extends Controller
{
    /**
     * @param mixed $data
     * @param array $groups
     * @param int   $status
     *
     * @return Response
     */
    protected function getJsonResponse($data, array $groups, $status = 200)
    {
        $serializer = SerializerBuilder::create()->build();

        return new Response(
            $serializer->serialize(
                $data,
                'json',
                empty($groups) ? null : SerializationContext::create()->setGroups($groups)
            ),
            $status,
            ['Content-Type' => 'application/json']
        );
    }

    /**
     * @param FormInterface $form
     *
     * @return array
     */
    public function getFormErrors(FormInterface $form)
    {
        $errors = [];

        foreach ($form->getErrors(true) as $error) {
            $errors[$error->getOrigin()->getName()] = $error->getMessage();
        }

        return $errors;
    }
} 