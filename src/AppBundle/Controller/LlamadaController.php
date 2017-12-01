<?php

namespace AppBundle\Controller;

use AppBundle\Forms\Type\FormTypeLlamada;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Llamada;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;

class LlamadaController extends Controller {
    
    /**
     * @Route("/llamada/nuevo/{codigoLlamada}", requirements={"codigoLlamada":"\d+"}, name="registrarLlamada")
     */
    public function nuevo(Request $request, $codigoLlamada = null) {
        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        $user = $this->getUser(); // trae el usuario actual
        $arllamada = new Llamada(); //instance class        
        if($codigoLlamada) {
            $arllamada = $em->getRepository('AppBundle:Llamada')->find($codigoLlamada);
        } else {            
            $arllamada->setEstadoAtendido(false);
            $arllamada->setEstadoSolucionado(false);            
        }
        
        $form = $this->createForm(FormTypeLlamada::class, $arllamada); //create form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $arllamada->setCodigoUsuarioRecibeFk($user->getCodigoUsuarioPk());
            if(!$codigoLlamada) {
                $arllamada->setFechaRegistro(new \DateTime('now'));
            }
            $em->persist($arllamada);
            $em->flush();
            return $this->redirect($this->generateUrl('listadoLlamadas'));
        }

        return $this->render('AppBundle:Llamada:crear.html.twig',
            array(
                'form' => $form->createView(),
        ));       
    }

    /**
     * @Route("/llamada/lista", name="listadoLlamadas")
     */
    public function lista(Request $request) {
        $em = $this->getDoctrine()->getManager();
        /** declara variables auxiliares para organizar el objeto final a devolver*/
        $atendidasPendientes = $em->getRepository('AppBundle:Llamada')->getAtendidasPendientes(); // contador de llamadas atendidas        
        $pendientes = $em->getRepository('AppBundle:Llamada')->getPendientes(); // contador de llamadas pendientes
        /** end variables auxiliares */
        $user = $this->getUser();                       
        $form = $this::createFormBuilder()->getForm();//form para manejar los cambios de estado
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){ // actualiza el estado de las llamadas            
            if($request->request->has('llamadaAtender')) {                
                $codigoLlamada = $request->request->get('llamadaAtender');
                $arLlamada = $em->getRepository('AppBundle:Llamada')->find($codigoLlamada);                
                if(!$arLlamada->getEstadoAtendido()){
                    $arLlamada->setEstadoAtendido(true);
                    $arLlamada->setCodigoUsuarioAtiendeFk($user->getCodigoUsuarioPk());
                    $arLlamada->setFechaGestion(new \DateTime('now'));
                    $em->persist($arLlamada);
                }
            }
            
            if($request->request->has('llamadaSolucionar')) {
                $codigoLlamada = $request->request->get('llamadaSolucionar');
                $arLlamada = $em->getRepository('AppBundle:Llamada')->find($codigoLlamada);
                if(!$arLlamada->getEstadoSolucionado()){                    
                    $arLlamada->setEstadoSolucionado(true);
                    $arLlamada->setCodigoUsuarioSolucionaFk($user->getCodigoUsuarioPk());
                    $arLlamada->setFechaSolucion(new \DateTime('now'));
                    $em->persist($arLlamada);
                }
            }
            $em->flush();
            return $this->redirect($this->generateUrl('listadoLlamadas'));
        }        
        $arLlamadas = $em->getRepository('AppBundle:Llamada')->findBy(array(), array('fechaRegistro' => 'DESC'));// consulta llamadas por
        // en index pagina con datos generales de la app
//        dump ($arLlamadas);
//        die();
        return $this->render('AppBundle:Llamada:listar.html.twig', [
            'llamadas' => $arLlamadas,
            'atendidasPendientes' => $atendidasPendientes,
            'pendientes' => $pendientes,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/llamada/lista/usuario", name="listadoLlamadasUsuario")
     */
    public function listaUsuario(Request $request){

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $id =  $user->getCodigoUsuarioPk();
        $atendidasPendientes = $em->getRepository('AppBundle:Llamada')->getAtendidasPendientesUsuario($id);
        $arLlamada = $em->getRepository('AppBundle:Llamada')->findBy(array('codigoUsuarioAtiendeFk' => $id, 'estadoAtendido' => 1, 'estadoSolucionado' => 0 ),array('fechaGestion' => 'DESC'));// consulta llamadas por usuario logueado
        $form = $this::createFormBuilder()->getForm(); // form para manejar actualizacion de estado de llamadas
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){ // actualiza el estado de las llamadas
            if($request->request->has('llamadaSolucionar')) {
                $codigoLlamada = $request->request->get('llamadaSolucionar');
                $arLlamada = $em->getRepository('AppBundle:Llamada')->find($codigoLlamada);
                if(!$arLlamada->getCodigoUsuarioSolucionaFk()){
                    $arLlamada->setEstadoSolucionado(true);
                    $arLlamada->setCodigoUsuarioSolucionaFk($id);
                    $em->persist($arLlamada);
                    $em->flush();
                    return $this->redirect($this->generateUrl('listadoLlamadasUsuario'));
                }
            }
        }


        return $this->render('AppBundle:Llamada:listarUsuario.html.twig', [
            'llamadas' => $arLlamada,
            'atendidas' => $atendidasPendientes,
            'form' => $form->createView(),
        ]);


    }


    public function getUser(){

        $token = $this->get('security.token_storage')->getToken();
        # e.g: $token->getUser();
        # e.g: $token->isAuthenticated();
        # [Careful]            ^ "Anonymous users are technically authenticated"
        // Get our user from that token
        $user = $token->getUser();

        return $user;

    }

}
