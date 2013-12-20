<?php

namespace Virgule\Bundle\MainBundle\Manager;

use Doctrine\ORM\EntityManager;
use Virgule\Bundle\MainBundle\Manager\BaseManager;
use Virgule\Bundle\MainBundle\Entity\Tag;

class TagManager extends BaseManager {

    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository('VirguleMainBundle:Tag');
    }
    
    /**
     * When creating or updating a document,
     * check if each tag already exists and then link it
     * or create a new one and link it
     */
    public function createOrAddTags($tagLabels) {
        $tagsToLink = Array();
        foreach ($tagLabels as $tagLabel) {
            $tagLabel = trim($tagLabel);
            if (! empty($tagLabel)) {
                $tag = $this->getRepository()->getTagByLabel($tagLabel);
                if ($tag == null) {
                    $t = new Tag();
                    $t->setLabel($tagLabel);
                    $tagsToLink[] = $t;
                } else {
                    $tagsToLink[] = $tag;
                }
            }
        }
        return $tagsToLink;
    }
}

?>