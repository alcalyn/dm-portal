<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;

class DefaultController extends FOSRestController
{
    /**
     * @Route("/api/me.{_format}", name="default_test", defaults={"_format"="json"})
     *
     * @View
     */
    public function getLoggedInUserAction()
    {
        $user = $this->getUser();

        return $user;
    }
}
