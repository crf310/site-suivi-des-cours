<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Language;

/**
 * Description of LoadLanguageData
 *
 * @author Guillaume Lucazeau
 */
class LoadLanguageData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $languages = Array('Français',
            'Anglais',
            'Allemand',
            'Farsi',
            'Russe',
            'Chinois',
            'Wolof',
            'Polonais',
            'Espagnol',
            'Portugais',
            'Hongrois',
            'Arabe',
            'Serbe',
            'Italie',
            'Tamoul',
            'Malgache',
            'Swahili',
            'Swati',
            'Tchèque',
            'Slovaque',
            'Bulgare',
            'Ukrainien',
            'Panjabi',
            'Armènien',
            'Soneke',
            'Bangla(Bengali)',
            'Indi',
            'Tibétai',
            'Dari',
            'Pashto',
            'Kazakh',
            'Turque',
            'Roumai',
            'Corée',
            'Afgha',
            'Moldave',
            'Quechua',
            'Cambodgie',
            'Sénégalais',
            'Betsimisaraka',
            'Peuhl',
            'Senifou',
            'Bambara',
            'Sinhala(Sinhalese)',
            'Gujarati',
            'Biélorusse',
            'Urdu',
            'Macédonien',
            'Amharique',
            'Bambara',
            'Patchou',
            'Mongol',
            'Grec',
            'Kabyle',
            'Vietnamien',
            'Malie',
            'Ivoirie',
            'Albanais',
            'Dida',
            'Dula',
            'Ilokano',
            'Pakistanais',
            'Egyptie',
            'Kurde',
            'Dialectedeguinée',
            'Népalais',
            'Japonais',
            'Yoruba',
            'Comorie',
            'Hébreu',
            'Ousb',
            'Arabe+hindi',
            'Afrikaaner',
            'Mandinge',
            'Singalais',
            'Créolemauricie',
            'Khassanke',
            'Erythrée',
            'Salinke',
            'Punjabi',
            'Georgie',
            'Igbo',
            'Hindi',
            'Ukrainienne',
            'Wenzhou',
            'Wenzhouch',
            'Mandarin',
            'Créole',
            'Lingala',
        );


        foreach ($languages as $i => $language) {
            echo $i;
            $l = new Language();
            $l->setName($language);
            $manager->persist($l);
            $this->addReference('language-' . $i, $l);
        }

        $manager->flush();
    }

    public function getOrder() {
        return 12;
    }

}

?>
