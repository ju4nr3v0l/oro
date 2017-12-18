<?php 

namespace AppBundle\Controller;

use AppBundle\Entity\Caso;
use AppBundle\Forms\Type\FormTypeCaso;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Llamada;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;

class GithubController extends Controller
{

	/**
     * @Route("/github",name="github")
     */
	public function githubController($response){


		dump($response);
		die();



	}


}