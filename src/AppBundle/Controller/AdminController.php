<?php

namespace AppBundle\Controller;



use AppBundle\Forms\Type\FormTypeUsuario;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Usuario;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;




class AdminController extends Controller
{

    /** usuarios */

    /**
     * @Route("/admin/nuevo/usuario/{codigoUsuarioPk}", requirements={"codigoUsuarioPk":"\d+"}, name="registrarUsuario")
     */

    public function nuevo(Request $request, $codigoUsuarioPk = null)
    {
        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        $user = $this->getUser(); // trae el usuario actual
        if($codigoUsuarioPk != null){ // valida si viene un parametro (idLlamada) para editar

            $arUsuario = $this->getDoctrine()->getManager()->getRepository('AppBundle:Usuario')->find($codigoUsuarioPk);//consulta la Usuario a editar

            if(!$arUsuario){

                throw $this->createNotFoundException("No Existe esa Usuario");

            } else {
                /** acá instancias form tipo Usuario */
                $form = $this->createForm(FormTypeUsuario::class, $arUsuario); //create form
                $form->handleRequest($request);

                /** fin instancia form */

                if ($form->isSubmitted() && $form->isValid()) { // se valida el submit del form
                    dump($form);
                    die();
                    $arUsuario->setCodigoRol(1);
                    $em->flush();
                    $url = $this->generateUrl('listadoUsuarios');
                    return $this->redirect($url);
                }

                return $this->render('AppBundle:Admin:editarUsuario.html.twig', [
                    'Usuarios' => $arUsuario,
                    'form' => $form->createView()
                ]);
            }
        } else { // si no viene un parametro se instancia el form vacio para crear Usuario

            $arUsuario = new Usuario(); //instance class
            $form = $this->createForm(FormTypeUsuario::class, $arUsuario);
             //create form
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($arUsuario);
                $em->flush();
                return $this->redirect($this->generateUrl('listaUsuario'));
            }

            return $this->render('AppBundle:Admin:crearUsuario.html.twig',
                array(
                    'form' => $form->createView(),

            ));
        }

    }

    /**
     * @Route("/Admin/Usuario/lista", name="listaUsuario")
     */

    public function lista(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        

        $arUsuarios = $em->getRepository('AppBundle:Usuario')->findAll(); // consulta todas las llamdas por fecha descendente


       

        // en index pagina con datos generales de la app
        return $this->render('AppBundle:Admin:listaUsuario.html.twig', [
            'usuarios' => $arUsuarios,
            
            

        ]);
    }
    /** end usuarios */

   /** categorias */

}
