<?php
/**
 * Created by PhpStorm.
 * User: WaRioO
 * Date: 23/10/2018
 * Time: 22:06
 */

namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class,
                array(
                    'label' => 'Pseudo (utilisé pour s\'authentifier)',
                    'attr' => array(
                        'maxlength' => 40,
                        'autofocus' => true,
                        'placeholder' => 'Saisissez un pseudo'
                    )
                ))
            ->add('lastName', TextType::class,
                array(
                    'label' => 'Votre nom',
                    'attr' => array(
                        'maxlength' => 100,
                        'placeholder' => 'Saisissez votre nom'
                    )
                ))
            ->add('firstName', TextType::class,
                array(
                    'label' => 'Votre prénom',
                    'attr' => array(
                        'maxlength' => 40,
                        'placeholder' => 'Saisissez votre prénom'
                    )
                ))
            ->add('email', EmailType::class,
                array(
                    'label' => 'Votre e-mail (ne sera pas utilisé pour SPAM ou autres, n\'apparaitra pas sur le site),
                 saisir un email valide car il sera utilisé pour valider votre compte ou 
                 en cas de perte de mot de passe',
                    'attr' => array(
                        'maxlength' => 100,
                        'placeholder' => 'Saisissez votre email'
                    )
                ))
            ->add('password', RepeatedType::class,
                array(
                    'type' => PasswordType::class,
                    'first_options' => array (
                    'label' => 'Saisissez votre mot de passe',
                    'attr' => array(
                        'maxlength' => 50,
                        'placeholder' => 'Saisissez un mot de passe'
                    )),
                    'second_options' => array (
                        'label' => 'Saisissez de nouveau votre mot de passe',
                        'attr' => array(
                            'maxlength' => 50,
                            'placeholder' => 'Saisissez de nouveau votre mot de passe'
                        ))
                ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => User::class,]);
    }
}
