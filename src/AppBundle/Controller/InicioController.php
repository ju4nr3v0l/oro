<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class InicioController extends Controller
{


    /**
     * @Route("/", name="inicio")
     */

    public function indexAction(Request $request)
    {

        return $this->render('AppBundle:Inicio:inicio.html.twig', [
            'juan' => 'Hola'
        ]);
    }

}