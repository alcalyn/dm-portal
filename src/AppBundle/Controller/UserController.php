<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class UserController extends FOSRestController
{

    /**
     * Get the logged in user from the OAuth token.
     * Useful for testing OAuth authentication.
     *
     * ### Response
     *
     * ```
     * {
     *      "id": 1,
     *      "username": "admin",
     *      "is_active": true
     * }
     * ```
     *
     * @ApiDoc(
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
     * @Route(
     *      "/api/me",
     *      methods={"GET"}
     * )
     *
     * @View
     */
    public function getLoggedInUserAction()
    {
        $user = $this->getUser();

        return $user;
    }
}
