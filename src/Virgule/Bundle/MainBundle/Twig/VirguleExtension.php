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
            'phoneNumber' => new \Twig_Filter_Method($this, 'phoneNumberFilter'),
        );
    }
    
    public function dayFilter($dayNumber, $upperFistChar = false) {
        $days = Array(1 => 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
        
        $day = $dayNumber;
        if (array_key_exists($dayNumber, $days)) {            
            $day = $days[$dayNumber];
        }
        if ($upperFistChar) {
            $day = ucfirst($day);
        }
        return $day;
    }
    
    public function phoneNumberFilter($phoneNumber) {
        $sPhoneNumber = '';
        if (isset($phoneNumber) && !empty($phoneNumber)) {
            $d = ' ';
            $sPhoneNumber = $phoneNumber[0] . $phoneNumber[1] . $d .$phoneNumber[2] . $phoneNumber[3] . $d .$phoneNumber[4] . $phoneNumber[5] . $d .$phoneNumber[6] . $phoneNumber[7] . $d .$phoneNumber[8] . $phoneNumber[9];

        }
        return $sPhoneNumber;
    }

    public function getName() {
        return 'virgule_extension';
    }

}

?>
