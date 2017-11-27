<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Forms\Type\FormTypeLlamada;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Llamada;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class LlamadaController extends Controller
{

    /**
     * @Route("/llamada", name="llamada")
     */
    public function nuevoLlamada(Request $request)
    {
        $llamada = new Llamada; //instance class
        $form = $this->createForm($llamada); //create form recordar que usamos formTypes

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
            ));
    }
}
