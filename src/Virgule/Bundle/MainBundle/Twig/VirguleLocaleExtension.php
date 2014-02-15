<?php
namespace Virgule\Bundle\MainBundle\Twig;

use Sonata\IntlBundle\Twig\Extension\LocaleExtension;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VirguleExtension
 *
 * @author guillaume
 */
class VirguleLocaleExtension extends LocaleExtension {
    
    private $addedCodes = Array('CN-54' => 'Tibet');
    
    public function getName() {
        return 'virgule__locale_extension';
    }
    
    public function getFilters() {
        return array(
            'country2' => new \Twig_Filter_Method($this, 'countryFilter'),
        );
    }
    
    /**
     * return the localized country name from the provided code
     *
     * @param  $code
     * @param  null   $locale
     * @return string
     */
    public function countryFilter($code, $locale = null) {
        if (array_key_exists($code, $this->addedCodes)) {
            return $this->addedCodes[$code];
        } else {
            return $this->helper->country($code, $locale);
        }
    }
}