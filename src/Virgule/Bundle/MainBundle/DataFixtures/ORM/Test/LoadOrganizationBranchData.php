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

        $branch2 = new OrganizationBranch();
        $branch2->setName("Delegation 2");
        $branch2->setAddress("Adresse délégation 2");
        $branch2->setEmailAddress("delegation2@example.com");
        $branch2->setPhoneNumber("0504030201");
        $branch2->setPresidentName("Président de la délégation 2");

        $branch3 = new OrganizationBranch();
        $branch3->setName("Delegation 3");
        $branch3->setAddress("Adresse délégation 3");
        $branch3->setEmailAddress("delegation3@example.com");
        $branch3->setPhoneNumber("0504030201");
        $branch3->setPresidentName("Président de la délégation 3");

        $manager->persist($branch1);
        $manager->persist($branch2);
        $manager->persist($branch3);

        $this->addReference('organization-1', $branch1);
        $this->addReference('organization-2', $branch2);
        $this->addReference('organization-3', $branch3);

        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }
}

?>
