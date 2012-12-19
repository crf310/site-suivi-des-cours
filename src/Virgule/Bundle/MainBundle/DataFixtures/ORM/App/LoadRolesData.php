<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\App;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Roles;

/**
 * Description of LoadTeacherData
 *
 * @author Guillaume Lucazeau
 */

class LoadRolesData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager) {
        $roleViewer = new Roles();
        $roleViewer->setCode("ROLE_VIEWER");
        $roleViewer->setLabel("Utilisateur (lecture seule)");
        
        $roleUser = new Roles();
        $roleUser->setCode("ROLE_USER");
        $roleUser->setLabel("Formateur");
        
        $roleSecretary = new Roles();
        $roleSecretary->setCode("ROLE_SECRETARY");
        $roleSecretary->setLabel("Secrétaire");
        
        $roleSuperSecretary = new Roles();
        $roleSuperSecretary->setCode("ROLE_SUPER_SECRETARY");
        $roleSuperSecretary->setLabel("Secrétaire général");        
        
        $roleAdmin = new Roles();
        $roleAdmin->setCode("ROLE_ADMIN");
        $roleAdmin->setLabel("Administrateur");        
        
        $roleSuperAdmin = new Roles();
        $roleSuperAdmin->setCode("ROLE_SUPER_ADMIN");
        $roleSuperAdmin->setLabel("Super administrateur");
        
        $manager->persist($roleViewer);
        $manager->persist($roleUser);
        $manager->persist($roleSecretary);
        $manager->persist($roleSuperSecretary);
        $manager->persist($roleAdmin);
        $manager->persist($roleSuperAdmin);
        
        $this->addReference('user-role', $roleUser);
        $this->addReference('admin-role', $roleSuperAdmin);
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 1;
    }
}

?>
