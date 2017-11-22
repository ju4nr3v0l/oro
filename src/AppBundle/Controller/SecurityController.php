<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Forms\Type\FormTypeLogin;

class SecurityController extends Controller
{
    /**
     * @Route("/acceso", name="acceso")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(FormTypeLogin::class, null, array(
            'action' => $this->generateUrl("acceso"),


            )
        );

        $form->handleRequest($request);


        // replace this example code with whatever you need
        return $this->render('AppBundle:Login:login.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction(){
        throw new \RuntimeException('Esta funcion jamas debe ser llamada directamente');
    }
}
