<?php

namespace AppBundle\Controller;



use AppBundle\Forms\Type\FormTypeLlamada;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Llamada;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;



class LlamadaController extends Controller
{

    /**
     * @Route("/registrarLlamada", name="registrarLlamada")
     */

    public function insertarLlamada(Request $request)
    {
        $fechaActual = new DateTime();
        $fechaActual = $fechaActual->format('Y-m-d H:i:s');

        $llamada = new Llamada(); //instance class
        $form = $this->createForm(FormTypeLlamada::class, $llamada); //create form
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
            $llamada->setFechaRegistro(new \DateTime('now'));
            $llamada->setEstadoAtendido(false);
            $llamada->setEstadoSolucionado(false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($llamada);
            dump ($llamada);
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

        $form = $this->createFormBuilder()->getForm();

        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $arLlamadas = $em->getRepository('AppBundle:Llamada')->findAll();

        if($form->isSubmitted() && $form->isValid()){
            if($request->request->get('llamadaAtender')) {
                $idLlamadaAtender = $request->request->get('llamadaAtender');
                dump($idLlamadaAtender );
                die();
                // acciones para actualizar el estado atender de esa llamada
            }
            if($request->request->get('llamadaSolucionar')) {
                $idLlamadaSolucionar = $request->request->get('llamadaSolucionar');
                // acciones para actualizar el estado solucionar de esa llamada
            }
        }

        // en index pagina con datos generales de la app
        return $this->render('AppBundle:Llamada:listar.html.twig', [
            'llamadas' => $arLlamadas,
            'form' => $form

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
            'llamadas' => $arLlamadas,
            'usuario'  => $user
        ]);


    }


    /**
     * @Route("/actualizarEstadoLlamadaUsuario/{codigoLlamadaPk}", requirements={"codigoLlamadaPk":"\d+"}, name="actualizarEstadoLlamadaUsuario")
     */

    public function actualizarEstadoLlamadaUsuario(Request $request, $codigoLlamadaPk)
    {

        $form = array('juan');
        $token = $this->get('security.token_storage')->getToken();
        # e.g: $token->getUser();
        # e.g: $token->isAuthenticated();
        # [Careful]            ^ "Anonymous users are technically authenticated"
        // Get our user from that token
        $user = $token->getUser();
        $em = $this->getDoctrine()->getManager();
        $arLlamadas = $em->getRepository('AppBundle:Llamada')->find($codigoLlamadaPk);

        $id =  $user->getCodigoUsuarioPk();
        $arLlamadas->setCodigoUsuarioAtiendeFk($id);
        $arLlamadas->setFechaGestion(new \DateTime('now'));
        $arLlamadas->setEstadoAtendido(true);
        $em->persist($arLlamadas);
        $em->flush();
        $url = $this->generateUrl('listadoLlamadasUsuario');
        return $this->redirect($url);






    }

    /**
     * @Route("/editarLlamada/{codigoLlamadaPk}", requirements={"codigoLlamadaPk":"\d+"}, name="editarLlamada")
     */

    public function editarLlamada(Request $request, $codigoLlamadaPk)
    {

        $token = $this->get('security.token_storage')->getToken();
        # e.g: $token->getUser();
        # e.g: $token->isAuthenticated();
        # [Careful]            ^ "Anonymous users are technically authenticated"
        // Get our user from that token
        $user = $token->getUser();

        $arLlamadas = $this->getDoctrine()->getManager()->getRepository('AppBundle:Llamada')->find($codigoLlamadaPk);
        if(!$arLlamadas){
            throw $this->createNotFoundException("No Existe esa llamada");

        } else {
            /** acá instancias form */

            $form = $this->createForm(FormTypeLlamada::class, $arLlamadas); //create form
            $form->handleRequest($request);

            /** fin instancia form */

            if ($form->isSubmitted() && $form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $url = $this->generateUrl('listadoLlamadasUsuario');
                return $this->redirect($url);
            }

            return $this->render('AppBundle:Llamada:editar.html.twig', [
                'form' => $form->createView(),
                'llamadas' => $arLlamadas,
                'usuario'  => $user,


            ]);

        }

    }

}
