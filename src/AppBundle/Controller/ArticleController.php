<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ArticleController extends FOSRestController
{

    /**
     * Get the list of articles
     *
     * ### Response
     *
     * ```
     * [{
     *      "id": 1,
     *      "title": "Article No 1",
     *      "description": "This is the first idea i have to make an article of this blog",
     *      "insertedAt": "2017-03-03T17:08:26+0000"
     *      "proposedBy": {
     *          "id": 1,
     *          "username": "Admin",
     *          "is_active": 1
     *      }
     * },{
     *      "id": 2,
     *      "title": "Article No 2",
     *      "description": "This is the second idea i have to make an article of this blog",
     *      "insertedAt": "2017-03-03T17:08:26+0000"
     *      "proposedBy": {
     *          "id": 1,
     *          "username": "Admin",
     *          "is_active": 1
     *      }
     * }]
     * ```
     *
     * @ApiDoc(
     *      section="Articles",
     *      headers={
     *         {
     *             "name"="Authorization",
     *             "description"="Contains OAuth Access token",
     *             "required"=true,
     *             "default"="Bearer XXX"
     *         }
     *      },
     *      statusCodes={
     *         200="Returned when user is authenticated successfully",
     *         403="Returned when authentication failed"
     *      }
     * )
     *
     * @View(serializerGroups={"article"})
     */
    public function getArticlesAction()
    {
        $this->checkUser();

        return $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Article')
            ->findAll();
    }

    private function checkUser()
    {
        if (null === $this->getUser()) {
            throw new UnauthorizedHttpException('No authenticated user');
        }
    }
}
