<?php

namespace Virgule\Bundle\MainBundle\Form;

use Doctrine\ORM\EntityRepository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
    
class ClassSessionType extends AbstractType {

    private $courseId;
    
    private $doctrine;

    public function __construct($courseId, RegistryInterface $doctrine) {
        $this->courseId = $courseId;
        $this->doctrine = $doctrine;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $now = new \DateTime('now');
        $sNow = $now->format('d/m/Y');
        $builder
                ->add('date', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'date', 'value' => $sNow)))
                ->add('summary', 'ckeditor', array(
                    'config' => array(
                        'toolbar' => array(
                            array(
                                'name' => 'document',
                                'items' => array('Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates'),
                            ),
                            '/',
                            array(
                                'name' => 'basicstyles',
                                'items' => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
                            ),
                        ),
                        'ui_color' => '#ffffff'
                        )))
                ->add('students', 'entity', array(
                        'class' => 'VirguleMainBundle:Student', 
                        'query_builder' => function(EntityRepository $er) {
                                            return $er->createQueryBuilder('s')
                                                ->innerJoin('s.courses', 'c2', 'WITH', 'c2.id = :courseId')
                                                ->add('orderBy', 's.lastname ASC')
                                                ->setParameter('courseId', $this->courseId);
                                            }, 
                        'multiple' => true, 'expanded' => 'true'))
                ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Virgule\Bundle\MainBundle\Entity\ClassSession'
        ));
    }

    public function getName() {
        return 'virgule_bundle_mainbundle_classsessiontype';
    }

}
