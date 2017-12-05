<?php
/**
 * Created by PhpStorm.
 * User: avera
 * Date: 4/12/17
 * Time: 11:47 AM
 */

namespace AppBundle\Forms\Type;




namespace AppBundle\Forms\Type;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class FormTypeCaso extends AbstractType{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add ('asunto', TextType::class,array(
                'attr' => array(
                    'id' => '_asunto',
                    'name' => '_asunto'
                )
            ))
            ->add ('correo', TextType::class,array(
                'attr' => array(
                    'id' => '_correo',
                    'name' => '_correo',
                    'required' => 'true'
                )
            ))
            ->add ('contacto', TextType::class,array(
                'attr' => array(
                    'id' => '_contacto',
                    'name' => '_contacto',
                    'required' => 'true'
                )
            ))
            ->add ('telefono', IntegerType::class,array(
                'attr' => array(
                    'id' => '_telefono',
                    'name' => '_telefono',
                    'required' => 'true'
                )
            ))
            ->add ('extension', IntegerType::class,array(
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
            ->add('clienteRel', EntityType::class, array(
                'class' => 'AppBundle:Cliente',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.nombreComercial', 'ASC');},
                'choice_label' => 'nombreComercial',
                'required' => true))
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