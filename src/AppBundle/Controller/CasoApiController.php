<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

class CasoApiController extends FOSRestController {

	/**
	 * @Rest\Get("/api/lista/casos/{codigoCliente}/{codigoCaso}", requirements={"codigoCaso" = "\d+","codigoCliente" = "\d+"}, defaults={"codigoCaso" = 0,"codigoCliente" = 0} )
	 */

	// listar los casos de un cliente al logueo
	public function lista( Request $request, $codigoCaso, $codigoCliente ) {

		if($codigoCaso == 0){
			$restresult = $this->getDoctrine()->getRepository('AppBundle:Caso')->findBy(array('codigoClienteFk' => $codigoCliente));
		} else {
			$restresult = $this->getDoctrine()->getRepository('AppBundle:Caso')->findBy(array('codigoClienteFk' => $codigoCliente,'codigoCasoPk' => $codigoCaso));
		}

		if ($restresult === null) {
			return new View("No hay casos", Response::HTTP_NOT_FOUND);
		}
		return $restresult;
	}

	/**
	 * @Rest\Post("/api/nuevo/casos/{caso}",  defaults={"caso" = null} )
	 */
	// crear nuevo caso de un cliente
	public function nuevo( Request $request, $caso ) {

		if($caso == null){ // acá logica para capturar y crear nuevo caso
			return new View("No hay ningun caso en la petición", Response::HTTP_NOT_FOUND);
		} else { // logica para crear un caso

			$restresult = null;
		}

		if ($restresult === null) {
			return new View("No hay casos", Response::HTTP_NOT_FOUND);
		}
		return $restresult;
	}

	/**
	 * @Rest\Post("/api/editar/casos/{caso}",  defaults={"caso" = null} )
	 */
	// editar el caso
	public function editar( Request $request, $caso ) {

		if($caso == null){ // acá logica para capturar y editar nuevo caso
			return new View("No hay ningun caso en la petición", Response::HTTP_NOT_FOUND);
		} else { // logica para editar un caso
			$restresult = null;
		}

		if ($restresult === null) {
			return new View("No hay casos", Response::HTTP_NOT_FOUND);
		}
		return $restresult;
	}

	/**
	 * @Rest\Get("/api/filtro/cliente/casos/{codigoCliente}/{estado}", requirements={"codigoCliente" = "\d+"}, defaults={"codigoCliente" = 0, "estado" = 0} )
	 */
	public function filtroClienteEstados( Request $request, $codigoCliente, $estado ) {

		if($codigoCliente == 0 && $estado == 0){ // acá logica para traer todos los casos de un cliente
			$restresult = null;
		} else {
			$restresult = null;
		}

		if ($restresult === null) {
			return new View("No hay casos", Response::HTTP_NOT_FOUND);
		}
		return $restresult;
	}
}
