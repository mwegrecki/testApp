<?php

namespace ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Entity\Article;
use ApiBundle\Form\ArticleType;

/**
 * Article controller.
 *
 * @Route("/article")
 */
class ArticleController extends AbstractApiController
{

    /**
     * Lists all Articles.
     *
     * @Route("/", name="article")
     * @Method("GET")
     * @ApiDoc(
     *  description="Get all articles"
     * )
     *
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('ApiBundle:Article')->findAll();

        return $this->getJsonResponse($articles, ['details']);
    }

    /**
     * Creates a new Article.
     *
     * @Route("/", name="article_create")
     * @Method("POST")
     * @ApiDoc(
     *  description="Create a new Article",
     *  input="ApiBundle\Form\ArticleType",
     *  output="ApiBundle\Entity\Article"
     * )
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(new ArticleType(), $article, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
        } else {
            return $this->getJsonResponse($this->getFormErrors($form), ['details'], 400);
        }

        return $this->getJsonResponse($article, ['details']);
    }

    /**
     * Finds and displays a Article.
     *
     * @Route("/{id}", name="article_show")
     * @Method("GET")
     * @ApiDoc(
     *  description="Get a Article by id",
     *  parameters={
     *      {"name"="id", "dataType"="integer", "required"=true, "description"="article id"}
     *  }
     * )
     *
     * @param int $id
     *
     * @return Response
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('ApiBundle:Article')->find($id);

        if (!$article) {
            return $this->getJsonResponse(['error' => 'Unable to find Article.'], [], 404);
        }

        return $this->getJsonResponse($article, ['details']);
    }
}
