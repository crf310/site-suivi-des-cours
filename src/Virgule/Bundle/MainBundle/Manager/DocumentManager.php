<?php

namespace Virgule\Bundle\MainBundle\Manager;

use Doctrine\ORM\EntityManager;
use Virgule\Bundle\MainBundle\Manager\BaseManager;

class DocumentManager extends BaseManager {

    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository('VirguleMainBundle:Document');
    }
    
    public function getAllDocuments() {
        $documents = $this->mergeDocumentsOnTags($this->getRepository()->getAllDocuments());
        return $documents;
    }
    
    private function mergeDocumentsOnTags($documents) {
        $mergedDocuments = Array();
        foreach ($documents as $document) {
            if (! array_key_exists($document['id'], $mergedDocuments)) {
                $mergedDocuments[$document['id']] = $document;
                $mergedDocuments[$document['id']]['tags'] = Array();
                $mergedDocuments[$document['id']]['classLevels'] = Array();
            }
            if (! in_array($document['tag_label'], $mergedDocuments[$document['id']]['tags'])) {
                $mergedDocuments[$document['id']]['tags'][] = $document['tag_label'];
            }
            if (! in_array($document['classLevel_label'], $mergedDocuments[$document['id']]['classLevels'])) {
                $mergedDocuments[$document['id']]['classLevels'][$document['classLevel_label']] = Array('classLevel_label' => $document['classLevel_label'], 'classLevel_htmlColorCode' => $document['classLevel_htmlColorCode']);
            }
        }
        return $mergedDocuments;
    }
}

?>