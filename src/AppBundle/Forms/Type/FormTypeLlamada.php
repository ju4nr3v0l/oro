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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add ('tema', TextareaType::class, array(
                'attr' => array(
                    'id' => '_tema',
                    'name' => '_tema',
                    'class' => 'form-control',
                    'required' => false
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
                    'name' => '_extension',
                    'class' => 'form-control'
                )
            ))
            ->add ('descripcion', TextareaType::class,array(
                'attr' => array(
                    'id' => '_descripcion',
                    'name' => '_descripcion',
                    'class' => 'form-control'
                )
            ))
            ->add ('fechaRegistro', DateTimeType::class,array(
                'attr' => array(
                    'id' => '_extension',
                    'name' => '_extension',
                    'class' => 'form-control'
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
                    'name' => '_extension',
                    'class' => 'form-control'
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
            ->add ('btnGuardar', SubmitType::class, array(
                'attr' => array(
                    'id' => '_btnGuardar',
                    'name' => '_btnGuardar'
                ), 'label' => 'GUARDAR'
            ))
        ;
    }
}