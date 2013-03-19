<?php

namespace Virgule\Bundle\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class MenuBuilder extends ContainerAware {

    public function mainMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');

        $menu->addChild('Accueil', array('route' => 'welcome'));
        $menu['Accueil']->setLinkAttribute('class', 'welcome');
        
        $menu->addChild('Compte-rendus', array('route' => 'classsession_index'));
        $menu['Compte-rendus']->setLinkAttribute('class', 'minutes');
        
        $menu->addChild('Planning des cours', array('route' => 'course_show_planning'));
        $menu['Planning des cours']->setLinkAttribute('class', 'schedule');
        
        $menu->addChild('Apprenants', array('route' => 'student_index'));
        $menu['Apprenants']->setLinkAttribute('class', 'students');
        
        $menu->addChild('Formateurs', array('route' => 'teacher_index'));
        $menu['Formateurs']->setLinkAttribute('class', 'teachers');
        
        $menu->addChild('Statistiques', array('route' => 'stats_index'));
        $menu['Statistiques']->setLinkAttribute('class', 'statistics');
        
        $menu->addChild('Délégation', array('route' => 'stats_index'));
        $menu['Délégation']->setLinkAttribute('class', 'organization_branch');
        
        $menu->addChild('Cartable', array('route' => 'stats_index'));
        $menu['Cartable']->setLinkAttribute('class', 'schoolbag');
        
        $menu->addChild('Administration', array('route' => 'admin_show_logs'));
        $menu['Administration']->setLinkAttribute('class', 'administration');
        
        $route = $this->container->get('request')->getRequestUri();
        
        if (strpos($route, '/course/')) {
            $menu['Planning des cours']->setCurrent(true);
        }
        if (strpos($route, '/classsession/')) {
            $menu['Compte-rendus']->setCurrent(true);
        }
        if (strpos($route, '/student/')) {
            $menu['Apprenants']->setCurrent(true);
        }
        if (strpos($route, '/teacher/')) {
            $menu['Formateurs']->setCurrent(true);
        }
        if (strpos($route, '/student/')) {
            $menu['Apprenants']->setCurrent(true);
        }
        if (strpos($route, '/student/')) {
            $menu['Apprenants']->setCurrent(true);
        }
    
        return $menu;
    }
}