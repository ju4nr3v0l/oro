<?php

namespace AppBundle\Controller;


use AppBundle\Forms\Type\FormTypeLlamada;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Llamada;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class LlamadaController extends Controller
{

    /**
     * @Route("/registrarLlamada", name="registrarLlamada")
     */

    public function insertarLlamada(Request $request)
    {


        $fechaActual = date("Y-m-d H:i:s");

        $llamada = new Llamada; //instance class
        $form = $this->createForm(FormTypeLlamada::class, $llamada); //create form
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            //$call = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($llamada);


            $em->flush();
            $url = $this->generateUrl('listadoLlamadas');
            return $this->redirect($url);
        }

        return $this->render('AppBundle:Llamada:crear.html.twig',
            array(
                'form' => $form->createView(),
                'fecha' => $fechaActual
            ));
    }

    /**
     * @Route("/listadoLlamadas", name="listadoLlamadas")
     */

    public function listarLlamada(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Llamada');
        $llamadas = $repository->findAll();

        // en index pagina con datos generales de la app
        return $this->render('AppBundle:Llamada:listar.html.twig', [
            'llamadas' => $llamadas
        ]);
    }
}
