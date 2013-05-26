<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\App;

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
        $languages = Array('Farsi', 'Wolof', 'Soneke', 'Tibétain', 'Dari', 'Pashto', 'Afghan', 'Moldave', 'Cambodgien', 'Sénégalais', 'Betsimisaraka', 'Peuhl', 'Senifou', 'Bambara', 'Sinhala(Sinhalese)', 'Gujarati', 'Urdu', 'Bambara', 'Patchou', 'Kabyle', 'Malien', 'Ivoirien', 'Dida', 'Dula', 'Ilokano', 'Pakistanais', 'Egyptien', 'Kurde', 'Dialecte de guinée', 'Yoruba', 'Comorien', 'Ousbek', 'Afrikaaner', 'Mandinge', 'Singalais', 'Créole mauricien', 'Khassanke', 'Erythréen', 'Salinke', 'Punjabi', 'Igbo', 'Wenzhou', 'Mandarin', 'Créole', 'Lingala',);

        $officialLanguages = Array('Anglais', 'Arabe', 'Chinois', 'Espagnol', 'Français', 'Russe', 'Albanais', 'Allemand', 'Arménien', 'Aymara', 'Bengalî', 'Catalan', 'Coréen', 'Croate', 'Danois', 'Finnois', 'Guarani', 'Grec', 'Hongrois', 'Italien', 'Kiswahili', 'Malais', 'Mongol', 'Néerlandais', 'Ourdou', 'Persan', 'Portugais', 'Quechua', 'Roumain', 'Samoan', 'Serbe', 'Sesotho', 'Slovaque', 'Slovène', 'Suédois', 'Tamoul', 'Turc', 'Afrikaans', 'Amharique', 'Araona', 'Azéri', 'Baure', 'Bésiro', 'Bichelamar', 'Biélorusse', 'Birman', 'Bulgare', 'Canichana', 'Cavineña', 'Cayubaba', 'Chácobo', 'Chichewa', 'Chimane', 'Cinghalais', 'Créole de Guinée-Bissau', 'Créole haïtien', 'Créole seychellois', 'Divehi', 'Dzongkha', 'Ese', 'Ejja', 'Estonien', 'Fidjien', 'Filipino', 'Géorgien', 'Gilbertin', 'Guarasu’we', 'Guarayu', 'Hébreu', 'Hindoustani', 'Hindi', 'Hiri Motu', 'Iban', 'Indonésien', 'Irlandais', 'Islandais', 'Itonama', 'Kallawaya', 'Kazakh', 'Khmer', 'Kichwa', 'Kirghiz', 'Kirundi', 'Lao', 'Langue des signes néo-zélandaise', 'Latin', 'Leko', 'Letton', 'Lituanien', 'Luxembourgeois', 'Macédonien', 'Machineri', 'Malgache', 'Maltais', 'Māori', 'Māori des Îles Cook', 'Maropa', 'Marshallais', 'Mojeño-Trinitario', 'Mojeño-Ignaciano', 'Monténégrin', 'Moré', 'Mosetén', 'Movima', 'Nauruan', 'Népalais', 'Norvégien', 'Ouzbek', 'Pacahuara', 'Pachto', 'Paluan', 'Polonais', 'Puquina', 'Sango', 'Shikomor', 'Shona', 'Shuar', 'Sindebele', 'Sirionó', 'Somali', 'Tacana', 'Tadjik', 'Tamazight', 'Tapiete', 'Tchèque', 'Tétoum', 'Tigrinya', 'Thaï', 'Tok Pisin', 'Tonguien', 'Toromona', 'Turkmène', 'Tuvaluan', 'Ukrainien', 'Uru-Chipaya', 'Vietnamien', 'Wichi', 'Yaminahua', 'Yuki', 'Yaracaré', 'Zamuco', 'Angaur', 'Occitan-Aranais', 'Basque', 'Cantonais', 'Carolinien', 'Chamorro', 'Galicien', 'Gallois', 'Hatohabei', 'Hawaïen', 'Inuktitut', 'Japonais', 'Ladin', 'Limbourgeois', 'Mannois', 'Mirandais', 'Ndébélé', 'Ouïghour', 'Romanche', 'Ruthène', 'Sarde', 'Sorabe', 'Sotho du Nord', 'Sotho du Sud', 'Swati', 'Tibétain', 'Tsonga', 'Tswana', 'Venda', 'Xhosa', 'Zoulou');

        $languages = array_merge($officialLanguages, $languages);

        foreach ($languages as $i => $language) {
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
