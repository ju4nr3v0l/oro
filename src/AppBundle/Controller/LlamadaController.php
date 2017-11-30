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




class LlamadaController extends Controller
{

    /**
     * @Route("/llamada/nueva", name="registrarLlamada")
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
            
            $user = $this->getUser();
            $id =  $user->getCodigoUsuarioPk();
            $llamada->setCodigoUsuarioRecibeFk($id);
            $llamada->setFechaRegistro(new \DateTime('now'));
            $llamada->setEstadoAtendido(false);
            $llamada->setEstadoSolucionado(false);
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
     * @Route("/llamada/lista", name="listadoLlamadas")
     */

    public function listarLlamada(Request $request)
    {   
        $arLlamadasNorm = array();
        $em = $this->getDoctrine()->getManager();
           
        $user = $this->getUser();
        $id =  $user->getCodigoUsuarioPk();


        $form = $this::createFormBuilder()->getForm();


        $form->handleRequest($request);


      
        $arLlamadas = $em->getRepository('AppBundle:Llamada')->findBy([],array('fechaRegistro' => 'DESC'));
        foreach ($arLlamadas as $key => $value) {
            $llamadaAc = new Llamada;
            $llamadaAc = $value;
            $arLlamadasNorm[$key]=$value;
            if($llamadaAc->getCodigoUsuarioAtiendeFk() != null){
                $usuarioAtiende = $em->getRepository('AppBundle:Usuario')->find($llamadaAc->getCodigoUsuarioAtiendeFk());
                $arLlamadasNorm[$key]->usuarioAtiende=$usuarioAtiende;
            };
            if($llamadaAc->getCodigoUsuarioSolucionaFk() != null){
                $usuarioSoluciona = $em->getRepository('AppBundle:Usuario')->find($llamadaAc->getCodigoUsuarioSolucionaFk());
                $arLlamadasNorm[$key]->usuarioSoluciona=$usuarioSoluciona;
            };
            
        }
       

        if($form->isSubmitted() && $form->isValid()){ // actualiza el estado de las
            
            if($request->request->has('llamadaAtender')) {
                
                $idLlamadaAtender = $request->request->get('llamadaAtender');
                $arLlamadaAtender = $em->getRepository('AppBundle:Llamada')->find($idLlamadaAtender);
                $arLlamadaAtender->setEstadoAtendido(true);
                $arLlamadaAtender->setCodigoUsuarioAtiendeFk($id);
                $arLlamadaAtender->setFechaGestion(new \DateTime('now'));
                $em->flush();
                $url = $this->generateUrl('listadoLlamadas');
                return $this->redirect($url);
                   
                    // acciones para actualizar el estado atender de esa llamada

            }
            if($request->request->has('llamadaSolucionar')) {
                $idLlamadaSolucionar = $request->request->get('llamadaSolucionar');

                $arLlamadaSolucionar = $em->getRepository('AppBundle:Llamada')->find($idLlamadaSolucionar);
                $arLlamadaSolucionar->setEstadoSolucionado(true);
                $arLlamadaSolucionar->setCodigoUsuarioSolucionaFk($id);
                $arLlamadaSolucionar->setFechaSolucion(new \DateTime('now'));
                $em->flush();
                $url = $this->generateUrl('listadoLlamadas');
                return $this->redirect($url);

                   
               
                // acciones para actualizar el estado solucionar de esa llamada
            }
        }

        // en index pagina con datos generales de la app
        return $this->render('AppBundle:Llamada:listar.html.twig', [
            'llamadas' => $arLlamadasNorm,
            'form' => $form->createView(),
            'usuario' => $user

        ]);
    }

    /**
     * @Route("/llamada/lista/usuario", name="listadoLlamadasUsuario")
     */

    public function listarLlamadaUsuario(Request $request){
        $form = $this::createFormBuilder()->getForm();

        $form->handleRequest($request);
        
        $user = $this->getUser();
        $id =  $user->getCodigoUsuarioPk();
        // en index pagina con datos generales de la app

        $em = $this->getDoctrine()->getManager();
        $arLlamadas = $em->getRepository('AppBundle:Llamada')->findBy(array('codigoUsuarioAtiendeFk' => $id),array('fechaGestion' => 'DESC'));
        if($form->isSubmitted() && $form->isValid()){ // actualiza el estado de las
            
            
            if($request->request->has('llamadaSolucionar')) {
                $idLlamadaSolucionar = $request->request->get('llamadaSolucionar');
                
                $arLlamadaSolucionar = $em->getRepository('AppBundle:Llamada')->find($idLlamadaSolucionar);
                $arLlamadaSolucionar->setEstadoSolucionado(true);
                $arLlamadaSolucionar->setCodigoUsuarioSolucionaFk($id);

                $em->flush();
                $url = $this->generateUrl('listadoLlamadasUsuario');
                return $this->redirect($url);   
               
                // acciones para actualizar el estado solucionar de esa llamada
            }
        }


        return $this->render('AppBundle:Llamada:listarUsuario.html.twig', [
            'llamadas' => $arLlamadas,
            'usuario'  => $user,
             'form' => $form->createView()
        ]);


    }


   

    /**
     * @Route("/llamada/nueva/{codigoLlamadaPk}", requirements={"codigoLlamadaPk":"\d+"}, name="editarLlamada")
     */

    public function editarLlamada(Request $request, $codigoLlamadaPk)
    {

        $user = $this->getUser();

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
                $url = $this->generateUrl('listadoLlamadas');
                return $this->redirect($url);
            }

            return $this->render('AppBundle:Llamada:editar.html.twig', [
                'form' => $form->createView(),
                'llamadas' => $arLlamadas,
                'usuario'  => $user,


            ]);

        }

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
