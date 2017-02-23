<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/api/test", name="default_test")
     */
    public function indexAction()
    {
        $clientManager = $this->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $client->setRedirectUris(array('http://www.example.com'));
        $client->setAllowedGrantTypes(array('token', 'authorization_code'));
        $clientManager->updateClient($client);

        return $this->redirect($this->generateUrl('fos_oauth_server_authorize', array(
            'client_id'     => $client->getPublicId(),
            'redirect_uri'  => 'http://www.exemple.com',
            'response_type' => 'code'
        )));

        return new JsonResponse([
            'ok' => true,
        ]);
    }
}
