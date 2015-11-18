<?php

namespace ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Entity\Answer;
use ApiBundle\Form\AnswerType;

/**
 * Answer controller.
 *
 * @Route("/answer")
 */
class AnswerController extends AbstractApiController
{

    /**
     * Creates a new Answer.
     *
     * @Route("/", name="answer_create")
     * @Method("POST")
     * @ApiDoc(
     *  description="Create a new Answer",
     *  input="ApiBundle\Form\AnswerType",
     *  output="ApiBundle\Entity\Answer"
     * )
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $answer = new Answer();
        $form = $this->createForm(new AnswerType(), $answer, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($answer);
            $em->flush();
        } else {
            return $this->getJsonResponse($this->getFormErrors($form), ['details'], 400);
        }

        return $this->getJsonResponse($answer, ['details']);
    }

}
