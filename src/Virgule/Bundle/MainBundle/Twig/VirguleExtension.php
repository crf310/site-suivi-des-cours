<?php
namespace Virgule\Bundle\MainBundle\Twig;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VirguleExtension
 *
 * @author guillaume
 */
class VirguleExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            'day' => new \Twig_Filter_Method($this, 'dayFilter'),
        );
    }
    
    public function dayFilter($dayNumber, $upperFistChar = false) {
        $days = Array(1 => 'lundi', 2 => 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
        
        $day = $days[$dayNumber];
        if ($upperFistChar) {
            $day = ucfirst($day);
        }
        return $day;
    }

    public function getName() {
        return 'virgule_extension';
    }

}

?>
