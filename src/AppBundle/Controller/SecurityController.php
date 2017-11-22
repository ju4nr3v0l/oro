<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller{

    /**
     * @Route("/acceso" , name="acceso")
     */

    public function  loginAction(){
        return $this->render("security/login.html.twig",[

        ]);
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction(){
        throw new \RuntimeException('Esta funcion jamas debe ser llamada directamente');
    }
}