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
     * @Route("/llamada/nuevo/{codigoLlamadaPk}", requirements={"codigoLlamadaPk":"\d+"}, name="registrarLlamada")
     */

    public function nuevo(Request $request, $codigoLlamadaPk = null)
    {
        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        $user = $this->getUser(); // trae el usuario actual
        if($codigoLlamadaPk != null){ // valida si viene un parametro (idLlamada) para editar

            $arLlamada = $this->getDoctrine()->getManager()->getRepository('AppBundle:Llamada')->find($codigoLlamadaPk);//consulta la llamada a editar

            if(!$arLlamada){

                throw $this->createNotFoundException("No Existe esa llamada");

            } else {
                /** acá instancias form tipo Llamada */
                $form = $this->createForm(FormTypeLlamada::class, $arLlamada); //create form
                $form->handleRequest($request);

                /** fin instancia form */

                if ($form->isSubmitted() && $form->isValid()) { // se valida el submit del form

                    $em->flush();
                    $url = $this->generateUrl('listadoLlamadas');
                    return $this->redirect($url);
                }

                return $this->render('AppBundle:Llamada:editar.html.twig', [
                    'llamadas' => $arLlamada,
                    'form' => $form->createView()
                ]);
            }
        } else { // si no viene un parametro se instancia el form vacio para crear llamada

            $arllamada = new Llamada(); //instance class
            $form = $this->createForm(FormTypeLlamada::class, $arllamada); //create form
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $id =  $user->getCodigoUsuarioPk();
                $arllamada->setCodigoUsuarioRecibeFk($id);
                $arllamada->setFechaRegistro(new \DateTime('now'));
                $arllamada->setEstadoAtendido(false);
                $arllamada->setEstadoSolucionado(false);
                $em->persist($arllamada);
                $em->flush();
                return $this->redirect($this->generateUrl('listadoLlamadas'));
            }

            return $this->render('AppBundle:Llamada:crear.html.twig',
                array(
                    'form' => $form->createView(),

            ));
        }

    }

    /**
     * @Route("/llamada/lista", name="listadoLlamadas")
     */

    public function lista(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        /** declara variables auxiliares para organizar el objeto final a devolver*/
        $countLlamadasAtendidas = 0; // contador de llamadas atendidas
        $countLlamadasSolucionadas = 0; // contador de llamadas solucionadas
        $countLlamadasPendientes = 0; // contador de llamadas pendientes por usar
        /** end variables auxiliares */
        $user = $this->getUser();
        $id =  $user->getCodigoUsuarioPk();

        $arLlamadas = $em->getRepository('AppBundle:Llamada')->findBy([],array('fechaRegistro' => 'DESC')); // consulta todas las llamdas por fecha descendente


        foreach ($arLlamadas as $key => $value) { // cuenta las llamadas dependiendo de su estado

            if($value->getEstadoAtendido()){
                $countLlamadasAtendidas++;
            }

            if($value->getEstadoSolucionado()){
                $countLlamadasSolucionadas++;
            }

            if(!$value->getEstadoAtendido() && !$value->getEstadoSolucionado()){
                $countLlamadasPendientes++;
            }

        }
        $contadores = array('contLlamadasAtendidas'=> $countLlamadasAtendidas,'contLlamadasSolucionadas' => $countLlamadasSolucionadas,'contLlamadasPendientes' => $countLlamadasPendientes);//setea la variable con los contadores para enviar al front

        $form = $this::createFormBuilder()->getForm();//form para manejar los cambios de estado
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){ // actualiza el estado de las llamadas
            
            if($request->request->has('llamadaAtender')) {
                
                $idLlamadaAtender = $request->request->get('llamadaAtender');
                $arLlamadaAtender = $em->getRepository('AppBundle:Llamada')->find($idLlamadaAtender);
                if(!$arLlamadaAtender->getEstadoAtendido()){
                    $arLlamadaAtender->setEstadoAtendido(true);
                    $arLlamadaAtender->setCodigoUsuarioAtiendeFk($id);
                    $arLlamadaAtender->setFechaGestion(new \DateTime('now'));

                }
            }

            if($request->request->has('llamadaSolucionar')) {
                $idLlamadaSolucionar = $request->request->get('llamadaSolucionar');
                if(!$idLlamadaSolucionar->getEstadoSolucionado()){
                    $arLlamadaSolucionar = $em->getRepository('AppBundle:Llamada')->find($idLlamadaSolucionar);
                    $arLlamadaSolucionar->setEstadoSolucionado(true);
                    $arLlamadaSolucionar->setCodigoUsuarioSolucionaFk($id);
                    $arLlamadaSolucionar->setFechaSolucion(new \DateTime('now'));
                    $em->persist($arLlamadaSolucionar);
                }

            }

            $em->flush();
            $url = $this->generateUrl('listadoLlamadas');
            return $this->redirect($url);
        }

        // en index pagina con datos generales de la app
        return $this->render('AppBundle:Llamada:listar.html.twig', [
            'llamadas' => $arLlamadas,
            'contadores' => $contadores,
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
        // contadores para informe de estado de llamadas
        $countLlamadasAtendidas = 0;
        $countLlamadasSolucionadas = 0;
        $countLlamadasPendientes = 0;

        $arLlamadas = $em->getRepository('AppBundle:Llamada')->findBy(array('codigoUsuarioAtiendeFk' => $id),array('fechaGestion' => 'DESC'));// consulta llamadas por usuario logueado

        foreach ($arLlamadas as $key => $value) {

            if($value->getEstadoAtendido()){
                $countLlamadasAtendidas++;
            }
            if($value->getEstadoSolucionado()){
                $countLlamadasSolucionadas++;
            }
            if($value->getEstadoAtendido() && !$value->getEstadoSolucionado()){
                $countLlamadasPendientes++;
            }

        }

        $contadores = array('contLlamadasAtendidas'=> $countLlamadasAtendidas,'contLlamadasSolucionadas' => $countLlamadasSolucionadas,'contLlamadasPendientes' => $countLlamadasPendientes);// contadores de los estados de las llamadas

        $form = $this::createFormBuilder()->getForm(); // form para manejar actualizacion de estado de llamadas
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){ // actualiza el estado de las llamadas
            
            
            if($request->request->has('llamadaSolucionar')) {
                $idLlamadaSolucionar = $request->request->get('llamadaSolucionar');
                $arLlamadaSolucionar = $em->getRepository('AppBundle:Llamada')->find($idLlamadaSolucionar);
                if(!$arLlamadaSolucionar->getCodigoUsuarioSolucionaFk()){
                    $arLlamadaSolucionar->setEstadoSolucionado(true);
                    $arLlamadaSolucionar->setCodigoUsuarioSolucionaFk($id);
                    $em->persist($arLlamadaSolucionar);
                    $em->flush();
                    return $this->redirect($this->generateUrl('listadoLlamadasUsuario'));
                }
            }
        }


        return $this->render('AppBundle:Llamada:listarUsuario.html.twig', [
            'llamadas' => $arLlamadas,
            'contadores' => $contadores,
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
