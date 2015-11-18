<?php

namespace ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Entity\Rating;
use ApiBundle\Form\RatingType;

/**
 * Rating controller.
 *
 * @Route("/rating")
 */
class RatingController extends AbstractApiController
{

    /**
     * Creates a new Rating.
     *
     * @Route("/", name="rate_create")
     * @Method("POST")
     * @ApiDoc(
     *  description="Create a new Rating",
     *  input="ApiBundle\Form\RatingType",
     *  output="ApiBundle\Entity\Rating"
     * )
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $rate = new Rating();
        $form = $this->createForm(new RatingType(), $rate, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rate);
            $em->flush();
        } else {
            return $this->getJsonResponse($this->getFormErrors($form), ['details'], 400);
        }

        return $this->getJsonResponse($rate, ['details']);
    }

}
