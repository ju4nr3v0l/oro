<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
     /**
      * @Route("/acceso", name="acceso")
      */
    public function loginAction(){

        $authenticationUtils = $this->get('security.authentication_utils');
        // Captura error de logueo si existe
        $error = $authenticationUtils->getLastAuthenticationError();
        // Nombre de usuario ingresado
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render(
            'security/login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );

    }

}