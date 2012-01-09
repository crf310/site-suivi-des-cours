<?php

namespace Virgule\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FormateursType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('actif_yn', 'checkbox')
            ->add('nomFormateur', 'text')
            ->add('prenomFormateur', 'text')
            ->add('telFixe', 'text')
            ->add('telPortable', 'text')
            ->add('adresseEmail', 'text')
            ->add('login', 'text')
            ->add('motDePasse', 'text')
            //->add('confirmMotDePasse', 'password')
            //->add('fkPermission')
        ;
    }

    public function getName()
    {
        return 'virgule_bundle_mainbundle_formateurstype';
    }
}
