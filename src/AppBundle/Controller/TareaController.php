<?php

/**
 * Created by Juan David Marulanda V.
 * User: @ju4nr3v0l
 * appSoga developers Team.
 */

namespace AppBundle\Controller;

use AppBundle\Forms\Type\FormTypeTarea;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Tarea;
use AppBundle\Entity\TareaTipo;
use Symfony\Component\HttpFoundation\Request;






class TareaController extends Controller
{

    /**
     * @Route("/tarea/nuevo/{codigoTarea}", requirements={"codigoTarea":"\d+"}, name="registrarTarea")
     */
    public function nuevo(Request $request, $codigoTarea = null)
    {

        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        $user = $this->getUser(); // trae el usuario actual
        $arTarea = new Tarea(); //instance class
        if($codigoTarea) {
            $arTarea = $em->getRepository('AppBundle:Llamada')->find($codigoTarea);
        } else {
            $arTarea->setEstadoTerminado(false);

        }

        $form = $this->createForm(FormTypeTarea::class, $arTarea); //create form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if(!$codigoTarea) {
                $id =  $user->getCodigoUsuarioPk();
                $arTarea->setFechaRegistro(new \DateTime('now'));
                $arTarea->setCodigoUsuarioRegistraFk($id);
                if($form["codigoUsuarioAsignaFk"]->getData() != null && $form["codigoUsuarioAsignaFk"]->getData() != $arTarea->getCodigoUsuarioAsignaFk()){
                    $arTarea->setFechaGestion(new \DateTime('now'));
                }
            } else if($form["codigoUsuarioAsignaFk"]->getData() != null){
                $arTarea->setFechaGestion(new \DateTime('now'));
            }

            $em->flush();
            return $this->redirect($this->generateUrl('listaTareaGeneral'));
        }

        return $this->render('AppBundle:Tarea:crear.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }


    /**
     * @Route("/tarea/lista", name="listaTareaGeneral")
     */
    public function listaGeneral(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $arTarea = $em->getRepository('AppBundle:Tarea')->findAll(); // consulta todas las llamadas por fecha descendente
        // en index pagina con datos generales de la app
        return $this->render('AppBundle:Tarea:listarUsuario.html.twig', [
            'tareas' => $arTarea,
        ]);
    }



    /**
     * @Route("/tarea/lista/usuario/{codigoUsuarioFk}", name="listaTareaUsuario")
     */
    public function listaUsuario(Request $request){

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $id =  $user->getCodigoUsuarioPk();
        $arTarea= $em->getRepository('AppBundle:Tarea')->findBy(array('codigoUsuarioAsignaFk' => $id),array('fechaGestion' => 'DESC'));// consulta llamadas por usuario logueado
        $form = $this::createFormBuilder()->getForm(); // form para manejar actualizacion de estado de llamadas
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){ // actualiza el estado de las llamadas
            if($request->request->has('TareaSolucionar')) {
                $codigoTarea= $request->request->get('TareaSolucionar');
                $arTarea = $em->getRepository('AppBundle:Tarea')->find($codigoTarea);

                    $arTarea->setEstadoTerminado(true);
                    $arTarea->setFechaSolucion(new \DateTime('now'));
                    $em->persist($arTarea);
                    $em->flush();
                    return $this->redirect($this->generateUrl('listaTareaUsuario'));

            }
        }


        return $this->render('AppBundle:Llamada:listarUsuario.html.twig', [
            'tareas' => $arTarea,
            'form' => $form->createView(),
        ]);


    }

}
