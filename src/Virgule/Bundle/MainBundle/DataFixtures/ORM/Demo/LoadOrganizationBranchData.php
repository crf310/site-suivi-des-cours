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
        $branch1->setPhoneNumber("0142067905");
        $branch1->setPresidentName("Ludovic Tessier");
        
        $branch2 = new OrganizationBranch();
        $branch2->setName("Délégation locale de Paris XIV");
        $branch2->setAddress("72 Rue HALLE 75014 PARIS");
        $branch2->setPhoneNumber("0143277307");
        $branch2->setPresidentName("John Doe");
        
        $branch3 = new OrganizationBranch();
        $branch3->setName("Délégation locale de Paris V");
        $branch3->setAddress("9, rue Laplace 75005 - Paris");
        $branch3->setPhoneNumber("0153108261");
        $branch3->setPresidentName("John Doe");
        
        $manager->persist($branch1);
        $manager->persist($branch2);
        $manager->persist($branch3);
        
        $this->addReference('deleg-3-10', $branch1);
        $this->addReference('deleg-14', $branch2);
        $this->addReference('deleg-5', $branch3);
                
        $manager->flush();
    }
    
    public function getOrder() {
        return 11;
    }
}

?>
