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
     * @Route("/llamada", name="llamada")
     */

    public function insertLlamada(Request $request)
    {

        $fechaActual = date("Y-m-d H:i:s");
        $llamada = new Llamada; //instance class
        $form = $this->createForm(FormTypeLlamada::class); //create form
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $call = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($call);
            $em->flush();
            return $this->redirect('/');
        }

        return $this->render('AppBundle:Llamada:crear.html.twig',
            array(
                'form' => $form->createView(),

                'date' => $fechaActual

            ));
    }
}
