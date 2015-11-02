<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Test;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\OrganizationBranch;

/**
 * Description of LoadTeacherData
 *
 * @author Guillaume Lucazeau
 */

class LoadOrganizationBranchData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {       
        $branch1 = new OrganizationBranch();
        $branch1->setName("Delegation 1");
        $branch1->setAddress("Adresse délégation 1");
        $branch1->setEmailAddress("delegation1@example.com");
        $branch1->setPhoneNumber("0102030405");
        $branch1->setPresidentName("Président de la délégation 1");
        
        $manager->persist($branch1);
        
        $this->addReference('organization-1', $branch1);
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 1;
    }
}

?>
