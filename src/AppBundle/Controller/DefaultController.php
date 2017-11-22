<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Forms\Type\FormTypeLogin;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(FormTypeLogin::class);

        $form->handleRequest($request);


        // replace this example code with whatever you need
        return $this->render('AppBundle:Login:login.html.twig', [
           'form' => $form->createView(),
        ]);
    }
}
