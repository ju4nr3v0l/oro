<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Llamada;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class InicioController extends Controller
{


    /**
     * @Route("/", name="inicio")
     */

    public function inicioAction(Request $request)
    {



        // en index pagina con datos generales de la app
        return $this->render('AppBundle:Inicio:inicio.html.twig', [

        ]);
    }

}