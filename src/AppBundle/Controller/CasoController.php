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

class CasoController extends Controller
{
    /**
     * @Route("/nuevo/", name="inicio")
     */
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/caso/nuevo/{codigoCaso}", requirements={"codigoCaso":"\d+"}, name="registrarCaso")
     */
    public function nuevo(Request $request, $codigoCaso = null) {
        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        $user = $this->getUser(); // trae el usuario actual
        $arCaso = new Caso(); //instance class

        if($codigoCaso) {
            $arllamada = $em->getRepository('AppBundle:Caso')->find($codigoCaso);
        } else {
            $arCaso->setEstadoAtendido(false);
            $arCaso->setEstadoSolucionado(false);
        }

        $form = $this->createForm(FormTypeCaso::class, $arCaso); //create form
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $arCaso->setCodigoUsuarioAtiendeFk($user->getCodigoUsuarioPk());
            if(!$codigoCaso) {
                $arCaso->setFechaRegistro(new \DateTime('now'));
            }
            $em->persist($arCaso);
            $em->flush();
            return $this->redirect($this->generateUrl('listadoCasos'));
        }

        return $this->render('AppBundle:Caso:nuevo.html.twig',
            array(
                'form' => $form->createView(),
            ));
    }

    /**
     * @Route("/caso/lista", name="listadoCasos")
     */
    public function lista(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $arCaso = $em->getRepository('AppBundle:Caso')->findAll();// consulta llamadas por

//        dump($arCaso);
//        die();

        return $this->render('AppBundle:Caso:listar.html.twig', [
            'casos' => $arCaso
        ]);
    }

}
