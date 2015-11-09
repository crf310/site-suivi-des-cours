<?php

namespace Virgule\Bundle\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrganizationBranchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('address')
            ->add('presidentName')
            ->add('phoneNumber')
            ->add('faxNumber')
            ->add('emailAddress')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\OrganizationBranch'
        ));
    }

    public function getName()
    {
        return 'virgule_bundle_mainbundle_organizationbranchtype';
    }
}
