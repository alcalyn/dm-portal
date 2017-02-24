<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class DefaultController extends FOSRestController
{
    /**
     * @Route("/api/test.{_format}", name="default_test", defaults={"_format"="json"})
     *
     * @Rest\View
     */
    public function getLoggedInUserAction()
    {
        return $this->getUser();
    }
}
