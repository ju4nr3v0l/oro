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

    public function Action(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Llamada');
        $llamadas = $repository->findAll();

        // en index pagina con datos generales de la app
        return $this->render('AppBundle:Inicio:inicio.html.twig', [
            'llamadas' => $llamadas
        ]);
    }

}