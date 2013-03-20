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
        
        // Administration
        $menu->addChild('Administration', array('uri' => '#'));
        $menu['Administration']->setAttribute('class', 'submenu');
        $menu['Administration']->setLinkAttribute('class', 'administration');
        
        $menu['Administration']->addChild('Gérer la délégation', array('uri' => '#'));
        $menu['Administration']['Gérer la délégation']->setLinkAttribute('class', 'red-cross');
        
        $menu['Administration']->addChild('Voir les logs', array('route' => 'admin_show_logs'));
        $menu['Administration']['Voir les logs']->setLinkAttribute('class', 'logs');
        if ($this->isActive($menu['Administration']['Voir les logs'])) {
            $menu['Administration']['Voir les logs']->setCurrent(true);
        }
        $nb_sublinks = count($menu['Administration']->getChildren());
        $menu['Administration']->setAttribute('nb_sublinks', $nb_sublinks);
        
        $adminRoutes = Array('show_logs');
        // Fin Administration
        
        $currentRoute = $this->container->get('request')->getRequestUri();
          
        foreach($adminRoutes as $adminRoute) {
            if (strpos($currentRoute, $adminRoute)) {                
                $menu['Administration']->setCurrent(true);
                $menu['Administration']->setAttribute('class', 'submenu open active');
            }
        }
        
        // Set main menu link as active if another link related is active
        // Example: set "Teachers" active if "Create new teacher" is active
        if (strpos($currentRoute, '/course/')) {
            $menu['Planning des cours']->setCurrent(true);
        }
        if (strpos($currentRoute, '/classsession/')) {
            $menu['Compte-rendus']->setCurrent(true);
        }
        if (strpos($currentRoute, '/student/')) {
            $menu['Apprenants']->setCurrent(true);
        }
        if (strpos($currentRoute, '/teacher/')) {
            $menu['Formateurs']->setCurrent(true);
        }
        if (strpos($currentRoute, '/student/')) {
            $menu['Apprenants']->setCurrent(true);
        }
        if (strpos($currentRoute, '/student/')) {
            $menu['Apprenants']->setCurrent(true);
        }
    
        return $menu;
    }
    
    private function isActive($link) {        
        $currentRoute = $this->container->get('request')->getRequestUri();
        if ($currentRoute == $link->getUri()) {
            return true;
        }
        return false;
    }
}