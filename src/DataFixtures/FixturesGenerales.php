<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Cliente;
use AppBundle\Entity\Estado;
use AppBundle\Entity\LlamadaCategoria;
use AppBundle\Entity\Rol;
use AppBundle\Entity\Usuario;

use Doctrine\Bundle\DoctrineCacheBundle\Tests\DependencyInjection\Fixtures;
use Doctrine\Common\Persistence\ObjectManager;

class OroFixtures extends Fixture
{
    public function load(ObjectManager $manager){

        $cliente = new Cliente();
        $estado = new Estado();
        $llamadaCategoria = new LlamadaCategoria();
        $rol = new Rol();
        $usuario = new Usuario();


        /** carga data dummy cliente */
        $cliente->setNit('99999999');
        $cliente->setRazonSocial('Empresa inicial');
        $cliente->setNombreComercial('Empresa de carga inicial');
        $manager->persist($cliente);
        $manager->flush();

        /** carga data dummy Estados */

        $estado->setNombre('Pendiente');
        $manager->persist($estado);
        $manager->flush();
        $estado->setNombre('Escalado');
        $manager->persist($estado);
        $manager->flush();
        $estado->setNombre('Solucionado');
        $manager->persist($estado);
        $manager->flush();

        /** carga data dummy llamada categoria */

        $llamadaCategoria->setNombre('Categoria 1');
        $manager->persist($llamadaCategoria);
        $manager->flush();
        $llamadaCategoria->setNombre('Categoria 2');
        $manager->persist($llamadaCategoria);
        $manager->flush();
        $llamadaCategoria->setNombre('Categoria 3');
        $manager->persist($llamadaCategoria);
        $manager->flush();


        /** carga dummy Rol */

        $rol->setNombre('ROLE_USER');
        $manager->persist($rol);
        $manager->flush();

        /**carga dummy usuario */

        $usuario->setCodigoClientePk('admin');
        $usuario->setClave('admin');
        $manager->persist($usuario);
        $manager->flush();

    }



}