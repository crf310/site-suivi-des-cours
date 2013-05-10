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
            'month' => new \Twig_Filter_Method($this, 'monthFilter'),
            'phoneNumber' => new \Twig_Filter_Method($this, 'phoneNumberFilter'),
            'gender' => new \Twig_Filter_Method($this, 'genderFilter'),
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
    
    public function monthFilter($monthNumber, $upperFistChar = false) {
        $months = Array(1 => 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
        
        $month = $monthNumber;
        if (array_key_exists($monthNumber, $months)) {            
            $month = $months[$monthNumber];
        }
        if ($upperFistChar) {
            $month = ucfirst($month);
        }
        return $month;
    }
    
    public function phoneNumberFilter($phoneNumber) {
        $sPhoneNumber = '';
        if (isset($phoneNumber) && !empty($phoneNumber)) {
            $d = ' ';
            $sPhoneNumber = $phoneNumber[0] . $phoneNumber[1] . $d .$phoneNumber[2] . $phoneNumber[3] . $d .$phoneNumber[4] . $phoneNumber[5] . $d .$phoneNumber[6] . $phoneNumber[7] . $d .$phoneNumber[8] . $phoneNumber[9];

        }
        return $sPhoneNumber;
    }
    
    public function genderFilter($genderCode, $upperFistChar = true) {
        $genders = Array('f' => 'féminin', 'm' => 'masculin');
        
        $gender = $genderCode;
        if (array_key_exists(strToLower($genderCode), $genders)) {            
            $gender = $genders[strToLower($genderCode)];
        }
        if ($upperFistChar) {
            $gender = ucfirst($gender);
        }
        return $gender;
    }

    public function getName() {
        return 'virgule_extension';
    }

}

?>
