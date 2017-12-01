<?php

namespace AppBundle\Controller;



use AppBundle\Entity\LlamadaCategoria;
use AppBundle\Forms\Type\FormTypeUsuario;
use AppBundle\Forms\Type\FormTypeCliente;
use AppBundle\Forms\Type\FormTypeCategoria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Cliente;
use Symfony\Component\HttpFoundation\Request;






class AdminController extends Controller
{

    /** usuarios */

    /**
     * @Route("/admin/usuario/nuevo/{codigoUsuarioPk}", requirements={"codigoUsuarioPk":"\d+"}, name="registrarUsuario")
     */

    public function nuevoUsuario(Request $request, $codigoUsuarioPk = null)
    {
        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        $user = $this->getUser(); // trae el usuario actual
        if($codigoUsuarioPk != null){ // valida si viene un parametro (idLlamada) para editar

            $arUsuario = $this->getDoctrine()->getManager()->getRepository('AppBundle:Usuario')->find($codigoUsuarioPk);//consulta la Usuario a editar

            if(!$arUsuario){

                throw $this->createNotFoundException("No Existe ese Usuario");

            } else {
                /** acá instancias form tipo Usuario */
                $form = $this->createForm(FormTypeUsuario::class, $arUsuario); //create form
                $form->handleRequest($request);

                /** fin instancia form */

                if ($form->isSubmitted() && $form->isValid()) { // se valida el submit del form
                    $arUsuario->setCodigoRol(1);
                    $em->flush();
                    return $this->redirect($this->generateUrl('listaUsuario'));
                }

                return $this->render('AppBundle:Admin:editarUsuario.html.twig', [
                    'usuarios' => $arUsuario,
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
     * @Route("/admin/usuario/lista", name="listaUsuario")
     */

    public function listaUsuario(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $arUsuarios = $em->getRepository('AppBundle:Usuario')->findAll(); // consulta todas las llamdas por fecha descendente
        // en index pagina con datos generales de la app
        return $this->render('AppBundle:Admin:listaUsuario.html.twig', [
            'usuarios' => $arUsuarios,
        ]);
    }
    /** end usuarios */


    /** clientes */

    /**
     * @Route("/admin/cliente/nuevo/{codigoClientePk}", requirements={"codigoClientePk":"\d+"}, name="registrarCliente")
     */

    public function nuevoCliente(Request $request, $codigoClientePk = null)
    {
        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        if($codigoClientePk != null){ // valida si viene un parametro (idCliente) para editar

            $arCliente = $this->getDoctrine()->getManager()->getRepository('AppBundle:Cliente')->find($codigoClientePk);//consulta la Usuario a editar

            if(!$arCliente){

                throw $this->createNotFoundException("No Existe ese Cliente");

            } else {
                /** acá instancias form tipo Cliente */
                $form = $this->createForm(FormTypeCliente::class, $arCliente); //create form
                $form->handleRequest($request);

                /** fin instancia form */

                if ($form->isSubmitted() && $form->isValid()) { // se valida el submit del form

                    $em->flush();
                    $url = $this->generateUrl('listaCliente');
                    return $this->redirect($url);
                }

                return $this->render('AppBundle:Admin:editarUsuario.html.twig', [
                    'clientes' => $arCliente,
                    'form' => $form->createView()
                ]);
            }
        } else { // si no viene un parametro se instancia el form vacio para crear Usuario

            $arCliente= new Cliente(); //instance class
            $form = $this->createForm(FormTypeCliente::class, $arCliente);
            //create form
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($arCliente);
                $em->flush();
                return $this->redirect($this->generateUrl('listaCliente'));
            }

            return $this->render('AppBundle:Admin:crearCliente.html.twig',
                array(
                    'form' => $form->createView(),

                ));
        }

    }




    /**
     * @Route("/admin/cliente/lista", name="listaCliente")
     */

    public function listaCliente(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $arClientes = $em->getRepository('AppBundle:Cliente')->findAll(); // consulta todas las llamdas por fecha descendente
        // en index pagina con datos generales de la app
        return $this->render('AppBundle:Admin:listaCliente.html.twig', [
            'clientes' => $arClientes,
        ]);
    }

   /** end clientes */


   /** categorias */

    /**
     * @Route("/admin/categoria/nuevo/{codigoCategoriaPk}", requirements={"codigoCategoriaPk":"\d+"}, name="registrarCategoria")
     */

    public function nuevoCategoria(Request $request, $codigoCategoriaPk = null)
    {
        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        if($codigoCategoriaPk != null){ // valida si viene un parametro (idLlamada) para editar

            $arCategoria= $this->getDoctrine()->getManager()->getRepository('AppBundle:LlamadaCategoria')->find($codigoCategoriaPk);//consulta la Usuario a editar

            if(!$arCategoria){

                throw $this->createNotFoundException("No Existe esa Categoria");

            } else {
                /** acá instancias form tipo Usuario */
                $form = $this->createForm(FormTypeCategoria::class, $arCategoria); //create form
                $form->handleRequest($request);

                /** fin instancia form */

                if ($form->isSubmitted() && $form->isValid()) { // se valida el submit del form
                    $em->flush();
                    return $this->redirect($this->generateUrl('listaCategoria'));
                }

                return $this->render('AppBundle:Admin:editarUsuario.html.twig', [
                    'categorias' => $arCategoria,
                    'form' => $form->createView()
                ]);
            }
        } else { // si no viene un parametro se instancia el form vacio para crear Usuario

            $arCategoria = new LlamadaCategoria(); //instance class
            $form = $this->createForm(FormTypeCategoria::class, $arCategoria);
            //create form
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($arCategoria);
                $em->flush();
                return $this->redirect($this->generateUrl('listaCategoria'));
            }

            return $this->render('AppBundle:Admin:crearCategoria.html.twig',
                array(
                    'form' => $form->createView(),

                ));
        }

    }



    /**
     * @Route("/admin/categoria/lista", name="listaCategoria")
     */

    public function listaCategoria(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $arCategorias = $em->getRepository('AppBundle:LlamadaCategoria')->findAll(); // consulta todas las llamdas por fecha descendente
        // en index pagina con datos generales de la app
        return $this->render('AppBundle:Admin:listaCategoria.html.twig', [
            'categorias' => $arCategorias,
        ]);
    }
   /** end categorias */

}
