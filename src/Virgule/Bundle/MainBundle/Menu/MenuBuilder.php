<?php

namespace Virgule\Bundle\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder extends ContainerAware {

    public function mainMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        
        $menu->addChild('Accueil', array('route' => 'welcome'));
        $menu['Accueil']->setLinkAttribute('class', 'welcome');
        
        /* Class reports */
        $menu->addChild('Compte-rendus', array('uri' => '#'));
        $menu['Compte-rendus']->setAttribute('class', 'submenu');
        $menu['Compte-rendus']->setLinkAttribute('class', 'minutes');
        
        $menu['Compte-rendus']->addChild('Tous les compte-rendus', array('route' => 'classsession_index'));
        $menu['Compte-rendus']['Tous les compte-rendus']->setLinkAttribute('class', 'minutes');
        $menu['Compte-rendus']->addChild('Par niveau', array('route' => 'classsession_index_per_level'));
        $menu['Compte-rendus']['Par niveau']->setLinkAttribute('class', 'minutes');
        
        /* Hidden children to set this menu active when we visit the pages */
        $menu['Compte-rendus']->addChild('RSS INDEX', array('route' => 'classsession_rss_index'))->setDisplay(false);
        
        $this->addNbSubLinks($menu, 'Compte-rendus');
        /* End class reports */
        
        $menu->addChild('Planning des cours', array('route' => 'course_show_planning'));
        $menu['Planning des cours']->setLinkAttribute('class', 'schedule');
        $menu['Planning des cours']->addChild('LISTE DES COURS', array('route' => 'course_index'))->setDisplay(false);
        
        
        /* Students */
        $menu->addChild('Apprenants', array('uri' => '#'));
        $menu['Apprenants']->setAttribute('class', 'submenu');
        $menu['Apprenants']->setLinkAttribute('class', 'students');
        
        $menu['Apprenants']->addChild('Tous les inscrits', array('route' => 'student_index'));
        $menu['Apprenants']['Tous les inscrits']->setLinkAttribute('class', 'students');        
        $menu['Apprenants']->addChild('Inscrits à plusieurs cours', array('route' => 'student_index_manyclasses'));
        $menu['Apprenants']['Inscrits à plusieurs cours']->setLinkAttribute('class', 'students');
        $menu['Apprenants']->addChild('Non inscrits', array('route' => 'student_index_noclass'));
        $menu['Apprenants']['Non inscrits']->setLinkAttribute('class', 'students');
        $menu['Apprenants']->addChild('Enregistrer un apprenant', array('route' => 'student_new'));
        $menu['Apprenants']['Enregistrer un apprenant']->setLinkAttribute('class', 'user_add');
        
        $this->addNbSubLinks($menu, 'Apprenants');
        /* End Students */
        
        $menu->addChild('Formateurs', array('route' => 'teacher_index'));
        $menu['Formateurs']->setLinkAttribute('class', 'teachers');
        
        $menu->addChild('Statistiques', array('route' => 'stats_index'));
        $menu['Statistiques']->setLinkAttribute('class', 'statistics');
        
        $orgBranchId = $this->container->get('request')->getSession()->get('organizationBranchId');
        $menu->addChild('Délégation', array('route' => 'organizationbranch_show', 'routeParameters' => array('id' => $orgBranchId)));
        $menu['Délégation']->setLinkAttribute('class', 'organization_branch');
        
        $menu->addChild('Cartable', array('route' => 'document'));
        $menu['Cartable']->setLinkAttribute('class', 'schoolbag');
        
        /* Administration */
        $menu->addChild('Administration', array('uri' => '#'));
        $menu['Administration']->setAttribute('class', 'submenu');
        $menu['Administration']->setLinkAttribute('class', 'administration');        
        
        $menu['Administration']->addChild('Gérer les semestres', array('route' => 'semester_index'));
        $menu['Administration']['Gérer les semestres']->setLinkAttribute('class', 'schedule-edit');
        
        $menu['Administration']->addChild('Gérer les niveaux', array('route' => 'classlevel_index'));
        $menu['Administration']['Gérer les niveaux']->setLinkAttribute('class', 'class-levels');
        
        $menu['Administration']->addChild('Gérer la délégation', array('uri' => '#'));
        $menu['Administration']['Gérer la délégation']->setLinkAttribute('class', 'red-cross');
        
        $menu['Administration']->addChild('Voir les logs', array('route' => 'admin_show_logs'));
        $menu['Administration']['Voir les logs']->setLinkAttribute('class', 'logs');
        
        $this->addNbSubLinks($menu, 'Administration');
        /* End Administration */
        
        /*
        $currentRoute = $this->container->get('request')->getRequestUri();
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
        }*/
    
        return $menu;
    }
    
    private function addNbSubLinks($menu, $index) {
        $nb_sublinks = 0;
        foreach ($menu[$index]->getChildren() as $child) {
            if ($child->isDisplayed()) {
                $nb_sublinks++;
            }
        }
        $menu[$index]->setAttribute('nb_sublinks', $nb_sublinks);
    }
}