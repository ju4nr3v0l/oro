<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

class AreaApiController extends FOSRestController {

	/**
	 * @Rest\Get("/api/lista/area")
	 */
	public function lista( Request $request) {

		set_time_limit(0);
		ini_set("memory_limit", -1);

		$restresult = $this->getDoctrine()->getRepository('AppBundle:Area')->findAll();

		if ($restresult === null) {
			return new View("No hay areas", Response::HTTP_NOT_FOUND);
		}
		return $restresult;
	}


}
