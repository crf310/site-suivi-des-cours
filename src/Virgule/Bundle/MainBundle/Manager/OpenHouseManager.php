<?php

namespace Virgule\Bundle\MainBundle\Manager;

use Doctrine\ORM\EntityManager;
use Virgule\Bundle\MainBundle\Manager\BaseManager;
use \Virgule\Bundle\MainBundle\Entity\OpenHouse;

class OpenHouseManager extends BaseManager {

  protected $em;

  public function __construct(EntityManager $em) {
    $this->em = $em;
  }

  public function getRepository() {
    return $this->em->getRepository('VirguleMainBundle:OpenHouse');
  }

  public function getOpenHouses($semesterId) {
    return $this->getRepository()->loadAllForSemester($semesterId);
  }

  public function getOpenHousesDates($semesterId) {
    $openHousesDates = array();
    $openHouses = $this->getOpenHouses($semesterId);
    foreach ($openHouses as $openHouse) {
      $openHousesDates[] = $openHouse->getDate();
    }
    return $openHousesDates;
  }

}

?>
