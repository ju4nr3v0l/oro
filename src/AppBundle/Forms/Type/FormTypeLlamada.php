<?php
/**
 * Created by Alejandro Vera Carrasquilla.
 * User: Avera
 * Date: 24/11/17
 * Time: 03:30 PM
 */

namespace AppBundle\Forms\Type;

use Doctrine\DBAL\Types\IntegerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormTypeLlamada extends AbstractType{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add ('tema', TextType::class, array(
                'attr' => array(
                    'id' => '_tema',
                    'name' => '_tema'
                )
            ))
            ->add ('telefono', TextType::class,array(
                'attr' => array(
                    'id' => '_telefono',
                    'name' => '_telefono'
                )
            ))
            ->add ('extension', TextType::class,array(
                'attr' => array(
                    'id' => '_extension',
                    'name' => '_extension'
                )
            ))
            ->add ('descripcion', TextType::class,array(
                'attr' => array(
                    'id' => '_descripcion',
                    'name' => '_descripcion'
                )
            ))
            ->add ('fechaRegistro', DateTimeType::class,array(
                'attr' => array(
                    'id' => '_extension',
                    'name' => '_extension'
                )
            ))
            ->add ('fechaGestion', DateTimeType::class,array(
                'attr' => array(
                    'id' => '_extension',
                    'name' => '_extension'
                )
            ))
            ->add ('fechaSolucion', DateTimeType::class,array(
                'attr' => array(
                    'id' => '_extension',
                    'name' => '_extension'
                )
            ))
            ->add ('codigoContacto', TextType::class,array(
                'attr' => array(
                    'id' => '_codigoContacto',
                    'name' => '_codigoContacto'
                )
            ))
//            ->add ('codigoCategoriaLlamadaFk', IntegerType::class,array(
//                'attr' => array(
//                    'id' => '_codigoCategoriaLlamadaFk',
//                    'name' => '_codigoCategoriaLlamadaFk'
//                )
//            ))
//            ->add ('codigoUsuarioRecibeFk', TextType::class,array(
//                'attr' => array(
//                    'id' => '_codigoUsuarioRecibeFk',
//                    'name' => '_codigoUsuarioRecibeFk'
//                )
//            ))
//            ->add ('codigoUsuarioAtiendeFk', TextType::class,array(
//                'attr' => array(
//                    'id' => '_codigoUsuarioAtiendeFk',
//                    'name' => '_codigoUsuarioAtiendeFk'
//                )
//            ))
//            ->add ('codigoEstadoLlamadaFk', IntegerType::class,array(
//                'attr' => array(
//                    'id' => '_codigoEstadoLlamadaFk',
//                    'name' => '_codigoEstadoLlamadaFk'
//                )
//            ))
//            ->add ('codigoClienteFk', IntegerType::class,array(
//                'attr' => array(
//                    'id' => '_codigoClienteFk',
//                    'name' => '_codigoClienteFk'
//                )
//            ))
//            Botón Guardar
            ->add ('Guardar', SubmitType::class, array(
                'attr' => array(
                    'class' => 'btn btn-danger waves-effect waves-light m-b-5'
                )
            ))
        ;
    }
}