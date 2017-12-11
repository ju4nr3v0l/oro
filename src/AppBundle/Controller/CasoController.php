<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Caso;
use AppBundle\Forms\Type\FormTypeCaso;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
     * @Route("/caso/nuevo/{codigoCaso}", requirements={"codigoCaso":"\d+"}, name="registrarCaso")
     */
    public function nuevo(Request $request, $codigoCaso = null) {
        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
//      $user = $this->getUser(); // trae el usuario actual
        $arCaso = new Caso(); //instance class

        if($codigoCaso) {
            $arCaso = $em->getRepository('AppBundle:Caso')->find($codigoCaso);
        } else {
            $arCaso->setEstadoAtendido(false);
            $arCaso->setEstadoSolucionado(false);
        }

        $form = $this->createForm(FormTypeCaso::class, $arCaso); //create form
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $arCaso->setCodigoUsuarioAtiendeFk($user->getCodigoUsuarioPk());
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
        $arCaso = $em->getRepository('AppBundle:Caso')->findAll();

        $user = $this->getUser();

        $form = $this::createFormBuilder()->getForm();//form para manejar los cambios de estado
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){ // actualiza el estado de las llamadas
            if($request->request->has('casoAtender')) {
                $codigoCaso = $request->request->get('casoAtender');
                $arCaso = $em->getRepository('AppBundle:Caso')->find($codigoCaso);
                if(!$arCaso->getEstadoAtendido()){
                    $arCaso->setEstadoAtendido(true);
                    $arCaso->setCodigoUsuarioAtiendeFk($user->getCodigoUsuarioPk());
                    $arCaso->setFechaGestion(new \DateTime('now'));
                    $em->persist($arCaso);
                }
            }

            if($request->request->has('casoSolucionar')) {
                $codigoCaso = $request->request->get('casoSolucionar');
                $arCaso = $em->getRepository('AppBundle:Caso')->find($codigoCaso);
                if(!$arCaso->getEstadoSolucionado()){
                    $arCaso->setEstadoSolucionado(true);
                    $arCaso->setCodigoUsuarioSolucionaFk($user->getCodigoUsuarioPk());
                    $arCaso->setFechaSolucion(new \DateTime('now'));
                    $em->persist($arCaso);
                }
            }
            $em->flush();
            return $this->redirect($this->generateUrl('listadoCasos'));
        }
//        dump($arCaso);
//        die();

        $filtroForm = $this::filtroCasoCliente ();

        return $this->render('AppBundle:Caso:listar.html.twig', [
            'casos' => $arCaso,
            'form' => $form->createView(),
            'filtroForm' => $filtroForm->createView ()
        ]);
    }

    private function filtroCasoCliente(){
        $form = $this->createFormBuilder ()
            ->add('casoCliente', EntityType::class, array(
                'class' => 'AppBundle:Cliente',
                'choice_label' => 'nombreComercial',
                'required' => true))
            ->add ('btnFiltrar',SubmitType::class, array (
                'label' => 'Filtrar',
                'attr' => array('class' => 'btn btn-primary btn-bordered waves-effect w-md waves-light m-b-5')
            ))
            ->getForm ();

        return $form;
    }
}
