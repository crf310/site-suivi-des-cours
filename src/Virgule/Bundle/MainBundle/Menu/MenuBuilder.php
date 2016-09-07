<?php

namespace Virgule\Bundle\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class MenuBuilder extends ContainerAware {

  public function mainMenu(FactoryInterface $factory, array $options) {
    $menu = $factory->createItem('root');

    $menu->addChild('Accueil', array('route' => 'welcome'));
    $menu['Accueil']->setLinkAttribute('class', 'welcome');

    $user = $this->container->get('security.context')->getToken()->getUser();
    if (!empty($user)) {
      $userId = $user->getId();
      $menu->addChild('Mon profil', array('route' => 'teacher_show', 'routeParameters' => array('id' => $userId)));
      $menu['Mon profil']->setLinkAttribute('class', 'profile');
    }

    /* Class reports */
    $menu->addChild('Comptes rendus', array('route' => 'classsession_index'));
    $menu['Comptes rendus']->setLinkAttribute('class', 'minutes');
    $menu['Comptes rendus']->addChild('Par niveau', array('route' => 'classsession_index_per_level'))->setDisplay(false);

    $this->addNbSubLinks($menu, 'Comptes rendus');
    /* End class reports */

    $menu->addChild('Planning des cours', array('route' => 'course_show_planning'));
    $menu['Planning des cours']->setLinkAttribute('class', 'schedule');
    $menu['Planning des cours']->addChild('LISTE DES COURS', array('route' => 'course_index'))->setDisplay(false);


    /* Students */
    $menu->addChild('Apprenants', array('uri' => '#'));
    $menu['Apprenants']->setAttribute('class', 'submenu');
    $menu['Apprenants']->setLinkAttribute('class', 'students');

    $menu['Apprenants']->addChild('Mes apprenants', array('route' => 'index_my_students'));
    $menu['Apprenants']['Mes apprenants']->setLinkAttribute('class', 'students');
    $menu['Apprenants']->addChild('Qui suivent un cours', array('route' => 'student_index'));
    $menu['Apprenants']['Qui suivent un cours']->setLinkAttribute('class', 'students');
    $menu['Apprenants']->addChild('Tous les apprenants', array('route' => 'student_index_all'));
    $menu['Apprenants']['Tous les apprenants']->setLinkAttribute('class', 'students');
    $menu['Apprenants']->addChild('Enregistrer un apprenant', array('route' => 'student_new'));
    $menu['Apprenants']['Enregistrer un apprenant']->setLinkAttribute('class', 'user_add');

    $this->addNbSubLinks($menu, 'Apprenants');
    /* End Students */

    $menu->addChild('Formateurs', array('route' => 'teacher_index'));
    $menu['Formateurs']->setLinkAttribute('class', 'teachers');
    $menu['Formateurs']->addChild('NEW TEACHER', array('route' => 'teacher_new'))->setDisplay(false);

    $menu->addChild('Statistiques', array('route' => 'stats_index'));
    $menu['Statistiques']->setLinkAttribute('class', 'statistics');

    $orgBranchId = $this->container->get('request')->getSession()->get('organizationBranchId');
    $menu->addChild('Délégation', array('route' => 'organizationbranch_show', 'routeParameters' => array('id' => $orgBranchId)));
    $menu['Délégation']->setLinkAttribute('class', 'organization_branch');

    $menu->addChild('Cartable de documents', array('route' => 'document_index'));
    $menu['Cartable de documents']->setLinkAttribute('class', 'schoolbag');
    $menu['Cartable de documents']->addChild('NEW DOCUMENT', array('route' => 'document_new'))->setDisplay(false);

    $menu->addChild('Aide', array('route' => 'help_faq'));
    $menu['Aide']->setLinkAttribute('class', 'help');

    return $menu;
  }

  public function adminMenu(FactoryInterface $factory, array $options) {
    $adminMenu = $this->mainMenu($factory, $options);
    /* Administration */
    $adminMenu->addChild('Administration', array('uri' => '#'));
    $adminMenu['Administration']->setAttribute('class', 'submenu');
    $adminMenu['Administration']->setLinkAttribute('class', 'administration');

    $adminMenu['Administration']->addChild('Gérer les semestres', array('route' => 'semester_index'));
    $adminMenu['Administration']['Gérer les semestres']->setLinkAttribute('class', 'schedule-edit');

    $adminMenu['Administration']->addChild('Gérer les niveaux', array('route' => 'classlevel_index'));
    $adminMenu['Administration']['Gérer les niveaux']->setLinkAttribute('class', 'class-levels');

    $adminMenu['Administration']->addChild('Gérer les délégations', array('route' => 'organizationbranch_index'));
    $adminMenu['Administration']['Gérer les délégations']->setLinkAttribute('class', 'red-cross');

    $this->addNbSubLinks($adminMenu, 'Administration');

    return $adminMenu;
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
