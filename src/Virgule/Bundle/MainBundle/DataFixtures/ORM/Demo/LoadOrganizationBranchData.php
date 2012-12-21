<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

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
        $branch1->setName("Délégation locale de Paris III et X");
        $branch1->setAddress("40 rue Albert Thomas 75010 PARIS");
        $branch1->setEmailAddress("dl.paris10@croix-rouge.fr");
        $branch1->setPhoneNumber("01 42 06 79 05");
        $branch1->setPresidentName("Ludovic Tessier");
        
        $branch2 = new OrganizationBranch();
        $branch2->setName("Délégation locale de Paris XIV");
        $branch2->setAddress("72 Rue HALLE 75014 PARIS");
        $branch2->setPhoneNumber("01 43 27 73 07 ");
        $branch2->setPresidentName("Ludovic Tessier");
        
        $manager->persist($branch1);
        $manager->persist($branch2);
        
        $this->addReference('deleg-3-10', $branch1);
                
        $manager->flush();
    }
    
    public function getOrder() {
        return 2;
    }
}

?>
