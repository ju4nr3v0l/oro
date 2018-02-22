<?php

namespace AppBundle\Controller;

use AppBundle\Forms\Type\FormTypeLlamada;
use DateTime;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Llamada;
use AppBundle\Entity\Cliente;
use AppBundle\Entity\NoContestan;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Session\Session;


class LlamadaController extends Controller
{

	var $strDqlLista = '';

	/**
	 * @Route("/llamada/nuevo/{codigoLlamada}", requirements={"codigoLlamada":"\d+"}, name="registrarLlamada")
	 */
	public function nuevo(Request $request, $codigoLlamada = null)
	{
		$em = $this->getDoctrine()->getManager(); // instancia el entity manager
		$user = $this->getUser(); // trae el usuario actual
		$arllamada = new Llamada(); //instance class
		if ($codigoLlamada) {
			$arllamada = $em->getRepository('AppBundle:Llamada')->find($codigoLlamada);
		} else {
			$arllamada->setEstadoAtendido(false);
			$arllamada->setEstadoSolucionado(false);
		}

		$form = $this->createForm(FormTypeLlamada::class, $arllamada); //create form
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$arllamada->setCodigoUsuarioRecibeFk($user->getCodigoUsuarioPk());
			if (!$codigoLlamada) {
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
	public function lista(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$paginator = $this->get('knp_paginator');
		$session = new session;
		$session->set('clienteRel',"");
		/** declara variables auxiliares para organizar el objeto final a devolver*/
		$atendidasPendientes = $em->getRepository('AppBundle:Llamada')->getAtendidasPendientes(); // contador de llamadas atendidas
		$pendientes = $em->getRepository('AppBundle:Llamada')->getPendientes(); // contador de llamadas pendientes
		/** end variables auxiliares */
		$formFiltro = $this->formularioFiltro();
		$formFiltro->handleRequest($request);
		$this->listar();
		if ($formFiltro->isValid()) {
			if ($formFiltro->get('BtnFiltrar')->isClicked()) {
				$this->filtrar($formFiltro);
				$this->listar();
			}
		}
		$user = $this->getUser();
		$form = $this::createFormBuilder()->getForm();//form para manejar los cambios de estado
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) { // actualiza el estado de las llamadas
			if ($request->request->has('llamadaAtender')) {
				$codigoLlamada = $request->request->get('llamadaAtender');
				$arLlamada = $em->getRepository('AppBundle:Llamada')->find($codigoLlamada);
				if (!$arLlamada->getEstadoAtendido()) {
					$arLlamada->setEstadoAtendido(true);
					$arLlamada->setCodigoUsuarioAtiendeFk($user->getCodigoUsuarioPk());
					$arLlamada->setFechaGestion(new \DateTime('now'));
					$em->persist($arLlamada);
				}
			}

			if ($request->request->has('llamadaContestan')) {
				$codigoLlamada = $request->request->get('llamadaContestan');
				$arLlamada = $em->getRepository('AppBundle:Llamada')->find($codigoLlamada);
				$arNoContestan = new NoContestan();
				$arLlamada->setEstadoNoContestan(true);
				$arNoContestan->setNoContestanRel($arLlamada);
				$arNoContestan->setCodigoUsuarioFk($user->getCodigoUsuarioPk());
				$arNoContestan->setFechaNoContestan(new \DateTime('now'));

				$em->persist($arLlamada);
				$em->persist($arNoContestan);

			}

			if ($request->request->has('llamadaSolucionar')) {
				$codigoLlamada = $request->request->get('llamadaSolucionar');
				$arLlamada = $em->getRepository('AppBundle:Llamada')->find($codigoLlamada);
				if (!$arLlamada->getEstadoSolucionado()) {
					$arLlamada->setEstadoSolucionado(true);
					$arLlamada->setCodigoUsuarioSolucionaFk($user->getCodigoUsuarioPk());
					$arLlamada->setFechaSolucion(new \DateTime('now'));
					$em->persist($arLlamada);
				}
			}
			$em->flush();
			return $this->redirect($this->generateUrl('listadoLlamadas'));
		}

		$arLlamadas = $paginator->paginate($em->createQuery($this->strDqlLista), $request->query->get('page', 1), 20);
		return $this->render('AppBundle:Llamada:listar.html.twig', array(
			'llamadas' => $arLlamadas,
			'atendidasPendientes' => $atendidasPendientes,
			'pendientes' => $pendientes,
			'formFiltro' => $formFiltro->createView(),
			'form' => $form->createView()));
	}

	/**
	 * @Route("/llamada/lista/usuario", name="listadoLlamadasUsuario")
	 */
	public function listaUsuario(Request $request)
	{

		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();
		$id = $user->getCodigoUsuarioPk();
		$atendidasPendientes = $em->getRepository('AppBundle:Llamada')->getAtendidasPendientesUsuario($id);
		$arLlamada = $em->getRepository('AppBundle:Llamada')->findBy(array('codigoUsuarioAtiendeFk' => $id, 'estadoAtendido' => 1, 'estadoSolucionado' => 0), array('fechaGestion' => 'DESC', 'estadoSolucionado' => 'ASC'));// consulta llamadas por usuario logueado
		$form = $this::createFormBuilder()->getForm(); // form para manejar actualizacion de estado de llamadas
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) { // actualiza el estado de las llamadas
			if ($request->request->has('llamadaSolucionar')) {
				$codigoLlamada = $request->request->get('llamadaSolucionar');
				$arLlamada = $em->getRepository('AppBundle:Llamada')->find($codigoLlamada);
				if (!$arLlamada->getCodigoUsuarioSolucionaFk()) {
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

	/**
	 * @Route("/llamada/lista/reporte", name="listadoLlamadasReporte")
	 */
	public function listaReporte(Request $request)
	{

		$em = $this->getDoctrine()->getManager();
		$paginator = $this->get('knp_paginator');
		// $user = $this->getUser();
		$session = new Session();
		$formFiltro = $this->formularioFiltro();
		$formFiltro->handleRequest($request);
		$this->listar();
		if ($formFiltro->isSubmitted() && $formFiltro->isValid()) {
			$this->filtrar($formFiltro);
			$this->listar();
		}

		$arLlamadas = $paginator->paginate($em->createQuery($this->strDqlLista), $request->query->get('page', 1));
		return $this->render('AppBundle:Llamada:listarGeneral.html.twig', [
			'llamadas' => $arLlamadas,
			//'user' => $user,
			'formFiltro' => $formFiltro->createView()
		]);
	}

	private function filtrar($formFiltro)
	{
		$session = new Session;
		$codigoCliente = "";
		if ($formFiltro->get('clienteRel')->getData()) {
			$codigoCliente = $formFiltro->get('clienteRel')->getData()->getCodigoClientePk();
		}
		$session->set('clienteRel', $codigoCliente);
	}

	private function formularioFiltro()
	{
		$em = $this->getDoctrine()->getManager();
		$session = new Session;
		$arrCliente = array('class' => 'AppBundle\Entity\Cliente', 'query_builder' => function (EntityRepository $er) {
			return $er->createQueryBuilder('c')
			          ->orderBy('c.razonSocial', 'ASC');
		},
		                    'choice_label' => 'nombreComercial',
		                    'required' => false,
		                    'placeholder' => "TODOS");

		$formFiltro = $this->createFormBuilder()
		                   ->add('clienteRel', EntityType::class, $arrCliente)
		                   ->add('BtnFiltrar', SubmitType::class, array('label' => 'Filtrar'))
		                   ->getForm();

		return $formFiltro;
	}

	private function listar()
	{
		$em = $this->getDoctrine()->getManager();
		$session = new Session();
		$this->strDqlLista = $em->getRepository('AppBundle:Llamada')->listaDql($session->get('clienteRel'));
	}


	public function getUser()
	{

		$token = $this->get('security.token_storage')->getToken();
		# e.g: $token->getUser();
		# e.g: $token->isAuthenticated();
		# [Careful]            ^ "Anonymous users are technically authenticated"
		// Get our user from that token
		$user = $token->getUser();

		return $user;

	}

}
