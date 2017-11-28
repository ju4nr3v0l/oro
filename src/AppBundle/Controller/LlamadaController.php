<?php

namespace AppBundle\Controller;


use AppBundle\AppBundle;
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

        $llamada = new Llamada(); //instance class
        $form = $this->createForm(FormTypeLlamada::class, $llamada); //create form
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            // Get our Token (representing the currently logged in user)
            // [New 3.0] Get the `token_storage` object (instead of calling upon `security.context`)
            $token = $this->get('security.token_storage')->getToken();
            # e.g: $token->getUser();
            # e.g: $token->isAuthenticated();
            # [Careful]            ^ "Anonymous users are technically authenticated"
            // Get our user from that token
            $user = $token->getUser();
            $id =  $user->getCodigoUsuarioPk();
            $llamada->setCodigoUsuarioRecibeFk($id);
            $llamada->setFechaRegistro($fechaActual);
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
        $arLlamadas = $em->getRepository('AppBundle:Llamada')->findAll();


        // en index pagina con datos generales de la app
        return $this->render('AppBundle:Llamada:listar.html.twig', [
            'llamadas' => $arLlamadas,

        ]);
    }

    /**
     * @Route("/listadoLlamadasUsuario", name="listadoLlamadasUsuario")
     */

    public function listarLlamadaUsuario(Request $request){
        // Get our Token (representing the currently logged in user)
        // [New 3.0] Get the `token_storage` object (instead of calling upon `security.context`)
                $token = $this->get('security.token_storage')->getToken();
        # e.g: $token->getUser();
        # e.g: $token->isAuthenticated();
        # [Careful]            ^ "Anonymous users are technically authenticated"
        // Get our user from that token
                $user = $token->getUser();
                $id =  $user->getCodigoUsuarioPk();
        // en index pagina con datos generales de la app

        $em = $this->getDoctrine()->getManager();
        $arLlamadas = $em->getRepository('AppBundle:Llamada')->findBy(array('codigoUsuarioRecibeFk' => $id));


        return $this->render('AppBundle:Llamada:listarUsuario.html.twig', [
            'llamadas' => $arLlamadas

        ]);


    }
}
