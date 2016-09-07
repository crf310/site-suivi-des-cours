<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\App;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Role;

/**
 * Description of LoadTeacherData
 *
 * @author Guillaume Lucazeau
 */
class LoadRolesData extends AbstractFixture implements OrderedFixtureInterface {

  public function load(ObjectManager $manager) {
    $roleGuest = new Role();
    $roleGuest->setRole("ROLE_GUEST");
    $roleGuest->setLabel("Invité");

    $roleUser = new Role();
    $roleUser->setRole("ROLE_USER");
    $roleUser->setLabel("Formateur");

    $roleSecretary = new Role();
    $roleSecretary->setRole("ROLE_SECRETARY");
    $roleSecretary->setLabel("Responsable");

    $roleSuperSecretary = new Role();
    $roleSuperSecretary->setRole("ROLE_SUPER_SECRETARY");
    $roleSuperSecretary->setLabel("Responsable général");

    $roleAdmin = new Role();
    $roleAdmin->setRole("ROLE_ADMIN");
    $roleAdmin->setLabel("Administrateur");

    $roleSuperAdmin = new Role();
    $roleSuperAdmin->setRole("ROLE_SUPER_ADMIN");
    $roleSuperAdmin->setLabel("Super administrateur");

    $manager->persist($roleGuest);
    $manager->persist($roleUser);
    $manager->persist($roleSecretary);
    $manager->persist($roleSuperSecretary);
    $manager->persist($roleAdmin);
    $manager->persist($roleSuperAdmin);

    $this->addReference('guest-role', $roleGuest);
    $this->addReference('user-role', $roleUser);
    $this->addReference('secretary-role', $roleSecretary);
    $this->addReference('super-secretary-role', $roleSuperSecretary);
    $this->addReference('admin-role', $roleAdmin);
    $this->addReference('super-admin-role', $roleSuperAdmin);

    $manager->flush();
  }

  public function getOrder() {
    return 1;
  }

}

?>
