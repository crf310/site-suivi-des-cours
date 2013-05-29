<?php
namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Tag;

/**
 * Description of LoadClassLevelData
 *
 * @author Guillaume Lucazeau
 */

class LoadTagData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {       
        $tag1 = new Tag();
        $tag1->setLabel("Grammaire");
        $tag2 = new Tag();
        $tag2->setLabel("Orthographe");
        $tag3 = new Tag();
        $tag3->setLabel("Singulier/Pluriel");
        $tag4 = new Tag();
        $tag4->setLabel("Administratif");
        $tag5 = new Tag();
        $tag5->setLabel("Masculin/Féminin");
        $tag6 = new Tag();
        $tag6->setLabel("Accueil");
        $tag7 = new Tag();
        $tag7->setLabel("Calcul");
        $tag8 = new Tag();
        $tag8->setLabel("Vie quotidienne");
        $tag9 = new Tag();
        $tag9->setLabel("Evaluation");
        $tag10 = new Tag();
        $tag10->setLabel("Réunion");
        
        $manager->persist($tag1);
        $manager->persist($tag2);
        $manager->persist($tag3);
        $manager->persist($tag4);
        $manager->persist($tag5);
        $manager->persist($tag6);
        $manager->persist($tag7);
        $manager->persist($tag8);
        $manager->persist($tag9);
        $manager->persist($tag10);
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 12;
    }
}

?>
