<?php

/**
 * Created by Juan David Marulanda V.
 * User: @ju4nr3v0l
 * appSoga developers Team.
 */

namespace AppBundle\Controller;

use AppBundle\Forms\Type\FormTypeTarea;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Tarea;
use AppBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class TareaController extends Controller
{
    var $strDqlLista = "";


    /**
     * @Route("/tarea/nuevo/{codigoTarea}", requirements={"codigoTarea":"\d+"}, name="registrarTarea")
     */
    public function nuevo(Request $request, $codigoTarea = null)
    {

        /**
         * @var Usuario $arUser
         **/
        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        $user = $this->getUser(); // trae el usuario actual
        $arTarea = new Tarea(); //instance class
        if ($codigoTarea) {
            $arTarea = $em->getRepository('AppBundle:Tarea')->find($codigoTarea);
        } else {
            $arTarea->setEstadoTerminado(false);

        }

        $form = $this->createForm(FormTypeTarea::class, $arTarea); //create form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$codigoTarea) {
                $id = $user->getCodigoUsuarioPk();
                $arTarea->setFechaRegistro(new \DateTime('now'));
                $arTarea->setCodigoUsuarioRegistraFk($id);
            }
            $arUser = $arTarea->getCodigoUsuarioAsignaFk();
            if ($arUser != null) {
                $arTarea->setFechaGestion(new \DateTime('now'));
                $arTarea->setCodigoUsuarioAsignaFk($arUser->getCodigoUsuarioPk());
            }
            $em->persist($arTarea);
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
        $paginator = $this->get('knp_paginator');
        $arTarea = new \AppBundle\Entity\Tarea();
     //   $session = $this->get('session');
//        $session->set('filtroEstado', 2);
        $formFiltro = $this->formularioFiltro();
        $formFiltro->handleRequest($request);
        $this->listar();
        if ($formFiltro->isValid()) {
            if ($formFiltro->get('BtnFiltrar')->isClicked()) {
                $this->filtrar($formFiltro);
                $this->listar();
            }
        }
        $form = $this::createFormBuilder()->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->request->has('TareaSolucionar')) {
                $codigoTarea = $request->request->get('TareaSolucionar');
                $arTarea = $em->getRepository('AppBundle:Tarea')->find($codigoTarea);
                if (!$arTarea->getEstadoTerminado()) {
                    $arTarea->setEstadoTerminado(true);
                    $arTarea->setFechaSolucion(new \DateTime('now'));
                }
            }
            if ($request->request->has('TareaVerificar')) {
                $codigoTarea = $request->request->get('TareaVerificar');
                $arTarea = $em->getRepository('AppBundle:Tarea')->find($codigoTarea);
                if (!$arTarea->getEstadoVerificado()) {
                    $arTarea->setFechaVerificado(new \DateTime('now'));
                    $arTarea->setEstadoVerificado(true);
                }
            }
            $em->persist($arTarea);
            $em->flush();
            return $this->redirect($this->generateUrl('listaTareaGeneral'));

        }

        $sinTerminar = 0;
        $sinAsignar = 0;
        $sinVerificar = 0;

        foreach ($arTarea as $key => $value) {
            if ($value->getCodigoUsuarioAsignaFk() == null) {
                $sinAsignar++;
            } else if (!$value->getEstadoTerminado()) {
                $sinTerminar++;
            } else if ($value->getEstadoTerminado() && !$value->getEstadoVerificado()) {
                $sinVerificar++;
            }
        }

        $arTarea = $paginator->paginate($em->createQuery($this->strDqlLista), $request->query->get('page', 1),10);
        return $this->render('AppBundle:Tarea:listar.html.twig', [
            'tareas' => $arTarea,
            'sinTerminar' => $sinTerminar,
            'sinAsignar' => $sinAsignar,
            'sinVerificar' => $sinVerificar,
            'formFiltro' => $formFiltro->createView(),
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/tarea/lista/usuario", name="listaTareaUsuario")
     */
    public function listaUsuario(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $arTarea = $em->getRepository('AppBundle:Tarea')->findBy(array('codigoUsuarioAsignaFk' => $user->getCodigoUsuarioPk()), array('estadoTerminado' => 'ASC', 'estadoVerificado' => 'ASC', 'fechaGestion' => 'DESC'));// consulta llamadas por usuario logueado
        $form = $this::createFormBuilder()->getForm(); // form para manejar actualizacion de estado de llamadas
        $form->handleRequest($request);
        $sinTerminar = 0;
        $sinVerificar = 0;
        foreach ($arTarea as $key => $value) {
            if (!$value->getEstadoTerminado()) {
                $sinTerminar++;
            } else if (!$value->getEstadoVerificado()) {
                $sinVerificar++;
            }
        }
        if ($form->isSubmitted() && $form->isValid()) { // actualiza el estado de las llamadas
            if ($request->request->has('TareaSolucionar')) {
                $codigoTarea = $request->request->get('TareaSolucionar');
                $arTarea = $em->getRepository('AppBundle:Tarea')->find($codigoTarea);
                if (!$arTarea->getEstadoTerminado()) {
                    $arTarea->setEstadoTerminado(true);
                    $arTarea->setFechaSolucion(new \DateTime('now'));
                    $em->persist($arTarea);

                }


            }
            if ($request->request->has('TareaVerificar')) {
                $codigoTarea = $request->request->get('TareaVerificar');
                $arTarea = $em->getRepository('AppBundle:Tarea')->find($codigoTarea);
                if (!$arTarea->getEstadoVerificado()) {
                    $arTarea->setFechaVerificado(new \DateTime('now'));
                    $arTarea->setEstadoVerificado(true);
                }
            }

            $em->flush();
            return $this->redirect($this->generateUrl('listaTareaUsuario'));
        }


        return $this->render('AppBundle:Tarea:listarUsuario.html.twig', [
            'tareas' => $arTarea,
            'sinTerminar' => $sinTerminar,
            'sinVerificar' => $sinVerificar,
            'form' => $form->createView(),
        ]);


    }


    /**
     * @Route("/tarea/comentario/registrar/{codigoTarea}",requirements={"codigoTarea":"\d+"}, name="registrarComentario")
     */
    public function registrarComentario(Request $request, $codigoTarea = null)
    {

        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        $arTarea = $em->getRepository('AppBundle:Tarea')->find($codigoTarea);
        $user = $em->getRepository('AppBundle:Usuario')->find($arTarea->getCodigoUsuarioAsignaFk());
        $arTarea->setCodigoUsuarioAsignaFk($user);
        $descripcion = $arTarea->getDescripcion();
        $tareaTipo = $arTarea->getTareaTipoRel();
        $form = $this->createForm(FormTypeTarea::class, $arTarea); //create form
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $idUser = $user->getCodigoUsuarioPk();
            $arTarea->setCodigoUsuarioAsignaFk($idUser);
            $arTarea->setDescripcion($descripcion);
            $arTarea->setTareaTipoRel($tareaTipo);
            $em->persist($arTarea);
            $em->flush();
            echo "<script>window.opener.location.reload();window.close()</script>";
        }

        return $this->render('AppBundle:Tarea:comentario.html.twig', [
            'form' => $form->createView(),
        ]);


    }

    /**
     * @Route("/tarea/lista/historico", name="listaTareaHistorico")
     */
    public function listaHistorico(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $arTarea = $em->getRepository('AppBundle:Tarea')->findBy(array('estadoVerificado' => true), array('fechaRegistro' => 'DESC'));

        // en index pagina con datos generales de la app
        return $this->render('AppBundle:Tarea:listarHistorico.html.twig', [
            'tareas' => $arTarea,
        ]);
    }


    private function formularioFiltro()
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $estado = "";
        if ($session->get('estado')) {
            $arTarea = $em->getRepository('AppBundle:Tarea')->findAll();
        };
        $formFiltro = $this::createFormBuilder()
            ->add('estado', ChoiceType::class, array('choices' => array('Todos' => '2', 'Sin resolver' => '0', 'Resueltos' => '1'),
                'label' => 'Filtro', 'data' => $session->get('filtroEstado', 2)))
            ->add('BtnFiltrar', SubmitType::class, array('label' => 'Filtrar'))
            ->getForm();

        return $formFiltro;

    }

    private function filtrar($formFiltro)
    {
        $session = new Session();
        $session->set('filtroEstado', $formFiltro->get('estado')->getData());

    }


    private function listar()
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $this->strDqlLista = $em->getRepository('AppBundle:Tarea')->listaDql($session->get('filtroEstado'));
    }
}
