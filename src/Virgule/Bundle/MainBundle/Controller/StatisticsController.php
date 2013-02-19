<?php

namespace Virgule\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Statistics controller.
 *
 * @Route("/stats")
 */
class StatisticsController extends AbstractVirguleController {

    /**
     * Display global statistics
     *
     * @Route("/", name="stats_index")
     * @Template()
     */
    public function indexAction() {         
        $em = $this->getDoctrine()->getManager();

        $semesterId = $this->getSelectedSemesterId();
        $students_genders = $em->getRepository('VirguleMainBundle:Student')->getGenders($semesterId);
        
        $total_students = 0;
        foreach ($students_genders as $students_gender) {
            $total_students = $total_students + $students_gender['nb_students'];
        }
        
        $students_countries = $em->getRepository('VirguleMainBundle:Student')->getCountries($semesterId);
        
        return array(
            'students_genders' => $students_genders, 
            'total_students' => $total_students,
            'students_countries' => $students_countries);
    }

}
