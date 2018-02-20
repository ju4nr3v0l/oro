<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

class CasoApiController extends FOSRestController {

	/**
	 * @Rest\Get("/api/get/casos")
	 */
	public function lista( Request $request ) {
		$restresult = $this->getDoctrine()->getRepository('AppBundle:Caso')->findAll();
		if ($restresult === null) {
			return new View("No hay casos", Response::HTTP_NOT_FOUND);
		}
		return $restresult;
	}

}
