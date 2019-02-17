<?php
/**
 * Created by PhpStorm.
 * User: WaRioO
 * Date: 18/10/2018
 * Time: 16:02
 */

namespace App\Form;


use App\Entity\News;
use Symfony\Component\Form\AbstractType;


use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,
                array(
                    'label' => 'Titre',
                    'attr' => array(
                        'maxlength' => '200',
                        'autofocus' => true,
                        'placeholder' => 'Saisissez un titre'
                    )))
            ->add('text', TextareaType::class,
                array(
                    'label' => 'Contenu',
                    'attr' => array(
                        'maxlength' => '4000',
                        'placeholder' => 'Saisissez le contenu de la news',
                        'rows' => '20'
                    )))
            ->add('author', TextType::class, array(
                'label' => 'Auteur',
                'empty_data' => 'Poker On Mars',
                'attr' => array(
                    'maxlength' => '100',
                    'placeholder' => 'Saisissez votre nom (Défaut : "Poker On Mars")'
                )))
            ->add('photo', FileType::class, array(
                'label' => 'Ajouter une photo en mode PAYSAGE (format png ou jpeg), minimum 600*450 pixels',
                'required' => false
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => News::class,]);
    }
}