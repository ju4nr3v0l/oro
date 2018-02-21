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
	 * @Rest\Get("/api/nuevo/casos/{codigoCaso}", requirements={"codigoCaso" = "\d+"}, defaults={"codigoCaso" = 0} )
	 */
	public function nuevo( Request $request, $codigoCaso ) {

		if($codigoCaso == 0){ // acá logica para capturar y crear nuevo caso
				$restresult = null;
		} else { // logica para editar un caso
			$restresult = null;
		}

		if ($restresult === null) {
			return new View("No hay casos", Response::HTTP_NOT_FOUND);
		}
		return $restresult;
	}

	/**
	 * @Rest\Get("/api/filtro/cliente/casos/{codigoCliente}", requirements={"codigoCliente" = "\d+"}, defaults={"codigoCliente" = 0} )
	 */
	public function filtroCliente( Request $request, $codigoCliente ) {

		if($codigoCliente == 0){ // acá logica para traer todos los casos de un cliente
			$restresult = null;
		} else {
			$restresult = null;
		}

		if ($restresult === null) {
			return new View("No hay casos", Response::HTTP_NOT_FOUND);
		}
		return $restresult;
	}

	/**
	 * @Rest\Get("/api/filtro/cliente/casos/{idCliente}/{estado}", requirements={"idCliente" = "\d+"}, defaults={"idCliente" = 0, "estado" = 0} )
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

	/**
	 * @Rest\Get("/api/filtro/cliente/casos/{estado}", defaults={"estadp" = 0} )
	 */
	public function filtroEstados( Request $request, $idCliente, $estado ) {

		if($estado == 0){ // acá logica para traer todos los casos de un cliente
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
