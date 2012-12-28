<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\App;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Country;

/**
 * Description of LoadCountriesData
 *
 * @author Guillaume Lucazeau
 */
class LoadCountriesData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
	$country1 = new Country();
	$country1->setIsoCode("AF");
	$country1->setLabel("AFGHANISTAN");
	$manager->persist($country1);
	$this->addReference('country-AF', $country1);

	$country2 = new Country();
	$country2->setIsoCode("ZA");
	$country2->setLabel("AFRIQUE DU SUD");
	$manager->persist($country2);
	$this->addReference('country-ZA', $country2);

	$country3 = new Country();
	$country3->setIsoCode("AX");
	$country3->setLabel("ÅLAND, ÎLES");
	$manager->persist($country3);
	$this->addReference('country-AX', $country3);

	$country4 = new Country();
	$country4->setIsoCode("AL");
	$country4->setLabel("ALBANIE");
	$manager->persist($country4);
	$this->addReference('country-AL', $country4);

	$country5 = new Country();
	$country5->setIsoCode("DZ");
	$country5->setLabel("ALGÉRIE");
	$manager->persist($country5);
	$this->addReference('country-DZ', $country5);

	$country6 = new Country();
	$country6->setIsoCode("DE");
	$country6->setLabel("ALLEMAGNE");
	$manager->persist($country6);
	$this->addReference('country-DE', $country6);

	$country7 = new Country();
	$country7->setIsoCode("AD");
	$country7->setLabel("ANDORRE");
	$manager->persist($country7);
	$this->addReference('country-AD', $country7);

	$country8 = new Country();
	$country8->setIsoCode("AO");
	$country8->setLabel("ANGOLA");
	$manager->persist($country8);
	$this->addReference('country-AO', $country8);

	$country9 = new Country();
	$country9->setIsoCode("AI");
	$country9->setLabel("ANGUILLA");
	$manager->persist($country9);
	$this->addReference('country-AI', $country9);

	$country10 = new Country();
	$country10->setIsoCode("AQ");
	$country10->setLabel("ANTARCTIQUE");
	$manager->persist($country10);
	$this->addReference('country-AQ', $country10);

	$country11 = new Country();
	$country11->setIsoCode("AG");
	$country11->setLabel("ANTIGUA-ET-BARBUDA");
	$manager->persist($country11);
	$this->addReference('country-AG', $country11);

	$country12 = new Country();
	$country12->setIsoCode("SA");
	$country12->setLabel("ARABIE SAOUDITE");
	$manager->persist($country12);
	$this->addReference('country-SA', $country12);

	$country13 = new Country();
	$country13->setIsoCode("AR");
	$country13->setLabel("ARGENTINE");
	$manager->persist($country13);
	$this->addReference('country-AR', $country13);

	$country14 = new Country();
	$country14->setIsoCode("AM");
	$country14->setLabel("ARMÉNIE");
	$manager->persist($country14);
	$this->addReference('country-AM', $country14);

	$country15 = new Country();
	$country15->setIsoCode("AW");
	$country15->setLabel("ARUBA");
	$manager->persist($country15);
	$this->addReference('country-AW', $country15);

	$country16 = new Country();
	$country16->setIsoCode("AU");
	$country16->setLabel("AUSTRALIE");
	$manager->persist($country16);
	$this->addReference('country-AU', $country16);

	$country17 = new Country();
	$country17->setIsoCode("AT");
	$country17->setLabel("AUTRICHE");
	$manager->persist($country17);
	$this->addReference('country-AT', $country17);

	$country18 = new Country();
	$country18->setIsoCode("AZ");
	$country18->setLabel("AZERBAÏDJAN");
	$manager->persist($country18);
	$this->addReference('country-AZ', $country18);

	$country19 = new Country();
	$country19->setIsoCode("BS");
	$country19->setLabel("BAHAMAS");
	$manager->persist($country19);
	$this->addReference('country-BS', $country19);

	$country20 = new Country();
	$country20->setIsoCode("BH");
	$country20->setLabel("BAHREÏN");
	$manager->persist($country20);
	$this->addReference('country-BH', $country20);

	$country21 = new Country();
	$country21->setIsoCode("BD");
	$country21->setLabel("BANGLADESH");
	$manager->persist($country21);
	$this->addReference('country-BD', $country21);

	$country22 = new Country();
	$country22->setIsoCode("BB");
	$country22->setLabel("BARBADE");
	$manager->persist($country22);
	$this->addReference('country-BB', $country22);

	$country23 = new Country();
	$country23->setIsoCode("BY");
	$country23->setLabel("BÉLARUS");
	$manager->persist($country23);
	$this->addReference('country-BY', $country23);

	$country24 = new Country();
	$country24->setIsoCode("BE");
	$country24->setLabel("BELGIQUE");
	$manager->persist($country24);
	$this->addReference('country-BE', $country24);

	$country25 = new Country();
	$country25->setIsoCode("BZ");
	$country25->setLabel("BELIZE");
	$manager->persist($country25);
	$this->addReference('country-BZ', $country25);

	$country26 = new Country();
	$country26->setIsoCode("BJ");
	$country26->setLabel("BÉNIN");
	$manager->persist($country26);
	$this->addReference('country-BJ', $country26);

	$country27 = new Country();
	$country27->setIsoCode("BM");
	$country27->setLabel("BERMUDES");
	$manager->persist($country27);
	$this->addReference('country-BM', $country27);

	$country28 = new Country();
	$country28->setIsoCode("BT");
	$country28->setLabel("BHOUTAN");
	$manager->persist($country28);
	$this->addReference('country-BT', $country28);

	$country29 = new Country();
	$country29->setIsoCode("BO");
	$country29->setLabel("BOLIVIE, l'ÉTAT PLURINATIONAL DE");
	$manager->persist($country29);
	$this->addReference('country-BO', $country29);

	$country30 = new Country();
	$country30->setIsoCode("BQ");
	$country30->setLabel("BONAIRE, SAINT-EUSTACHE ET SABA");
	$manager->persist($country30);
	$this->addReference('country-BQ', $country30);

	$country31 = new Country();
	$country31->setIsoCode("BA");
	$country31->setLabel("BOSNIE-HERZÉGOVINE");
	$manager->persist($country31);
	$this->addReference('country-BA', $country31);

	$country32 = new Country();
	$country32->setIsoCode("BW");
	$country32->setLabel("BOTSWANA");
	$manager->persist($country32);
	$this->addReference('country-BW', $country32);

	$country33 = new Country();
	$country33->setIsoCode("BV");
	$country33->setLabel("BOUVET, ÎLE");
	$manager->persist($country33);
	$this->addReference('country-BV', $country33);

	$country34 = new Country();
	$country34->setIsoCode("BR");
	$country34->setLabel("BRÉSIL");
	$manager->persist($country34);
	$this->addReference('country-BR', $country34);

	$country35 = new Country();
	$country35->setIsoCode("BN");
	$country35->setLabel("BRUNEI DARUSSALAM");
	$manager->persist($country35);
	$this->addReference('country-BN', $country35);

	$country36 = new Country();
	$country36->setIsoCode("BG");
	$country36->setLabel("BULGARIE");
	$manager->persist($country36);
	$this->addReference('country-BG', $country36);

	$country37 = new Country();
	$country37->setIsoCode("BF");
	$country37->setLabel("BURKINA FASO");
	$manager->persist($country37);
	$this->addReference('country-BF', $country37);

	$country38 = new Country();
	$country38->setIsoCode("BI");
	$country38->setLabel("BURUNDI");
	$manager->persist($country38);
	$this->addReference('country-BI', $country38);

	$country39 = new Country();
	$country39->setIsoCode("KY");
	$country39->setLabel("CAÏMANS, ÎLES");
	$manager->persist($country39);
	$this->addReference('country-KY', $country39);

	$country40 = new Country();
	$country40->setIsoCode("KH");
	$country40->setLabel("CAMBODGE");
	$manager->persist($country40);
	$this->addReference('country-KH', $country40);

	$country41 = new Country();
	$country41->setIsoCode("CM");
	$country41->setLabel("CAMEROUN");
	$manager->persist($country41);
	$this->addReference('country-CM', $country41);

	$country42 = new Country();
	$country42->setIsoCode("CA");
	$country42->setLabel("CANADA");
	$manager->persist($country42);
	$this->addReference('country-CA', $country42);

	$country43 = new Country();
	$country43->setIsoCode("CV");
	$country43->setLabel("CAP-VERT");
	$manager->persist($country43);
	$this->addReference('country-CV', $country43);

	$country44 = new Country();
	$country44->setIsoCode("CF");
	$country44->setLabel("CENTRAFRICAINE, RÉPUBLIQUE");
	$manager->persist($country44);
	$this->addReference('country-CF', $country44);

	$country45 = new Country();
	$country45->setIsoCode("CL");
	$country45->setLabel("CHILI");
	$manager->persist($country45);
	$this->addReference('country-CL', $country45);

	$country46 = new Country();
	$country46->setIsoCode("CN");
	$country46->setLabel("CHINE");
	$manager->persist($country46);
	$this->addReference('country-CN', $country46);

	$country47 = new Country();
	$country47->setIsoCode("CX");
	$country47->setLabel("CHRISTMAS, ÎLE");
	$manager->persist($country47);
	$this->addReference('country-CX', $country47);

	$country48 = new Country();
	$country48->setIsoCode("CY");
	$country48->setLabel("CHYPRE");
	$manager->persist($country48);
	$this->addReference('country-CY', $country48);

	$country49 = new Country();
	$country49->setIsoCode("CC");
	$country49->setLabel("COCOS (KEELING), ÎLES");
	$manager->persist($country49);
	$this->addReference('country-CC', $country49);

	$country50 = new Country();
	$country50->setIsoCode("CO");
	$country50->setLabel("COLOMBIE");
	$manager->persist($country50);
	$this->addReference('country-CO', $country50);

	$country51 = new Country();
	$country51->setIsoCode("KM");
	$country51->setLabel("COMORES");
	$manager->persist($country51);
	$this->addReference('country-KM', $country51);

	$country52 = new Country();
	$country52->setIsoCode("CG");
	$country52->setLabel("CONGO");
	$manager->persist($country52);
	$this->addReference('country-CG', $country52);

	$country53 = new Country();
	$country53->setIsoCode("CD");
	$country53->setLabel("CONGO, LA RÉPUBLIQUE DÉMOCRATIQUE DU");
	$manager->persist($country53);
	$this->addReference('country-CD', $country53);

	$country54 = new Country();
	$country54->setIsoCode("CK");
	$country54->setLabel("COOK, ÎLES");
	$manager->persist($country54);
	$this->addReference('country-CK', $country54);

	$country55 = new Country();
	$country55->setIsoCode("KR");
	$country55->setLabel("CORÉE, RÉPUBLIQUE DE");
	$manager->persist($country55);
	$this->addReference('country-KR', $country55);

	$country56 = new Country();
	$country56->setIsoCode("KP");
	$country56->setLabel("CORÉE, RÉPUBLIQUE POPULAIRE DÉMOCRATIQUE DE");
	$manager->persist($country56);
	$this->addReference('country-KP', $country56);

	$country57 = new Country();
	$country57->setIsoCode("CR");
	$country57->setLabel("COSTA RICA");
	$manager->persist($country57);
	$this->addReference('country-CR', $country57);

	$country58 = new Country();
	$country58->setIsoCode("CI");
	$country58->setLabel("CÔTE D'IVOIRE");
	$manager->persist($country58);
	$this->addReference('country-CI', $country58);

	$country59 = new Country();
	$country59->setIsoCode("HR");
	$country59->setLabel("CROATIE");
	$manager->persist($country59);
	$this->addReference('country-HR', $country59);

	$country60 = new Country();
	$country60->setIsoCode("CU");
	$country60->setLabel("CUBA");
	$manager->persist($country60);
	$this->addReference('country-CU', $country60);

	$country61 = new Country();
	$country61->setIsoCode("CW");
	$country61->setLabel("CURAÇAO");
	$manager->persist($country61);
	$this->addReference('country-CW', $country61);

	$country62 = new Country();
	$country62->setIsoCode("DK");
	$country62->setLabel("DANEMARK");
	$manager->persist($country62);
	$this->addReference('country-DK', $country62);

	$country63 = new Country();
	$country63->setIsoCode("DJ");
	$country63->setLabel("DJIBOUTI");
	$manager->persist($country63);
	$this->addReference('country-DJ', $country63);

	$country64 = new Country();
	$country64->setIsoCode("DO");
	$country64->setLabel("DOMINICAINE, RÉPUBLIQUE");
	$manager->persist($country64);
	$this->addReference('country-DO', $country64);

	$country65 = new Country();
	$country65->setIsoCode("DM");
	$country65->setLabel("DOMINIQUE");
	$manager->persist($country65);
	$this->addReference('country-DM', $country65);

	$country66 = new Country();
	$country66->setIsoCode("EG");
	$country66->setLabel("ÉGYPTE");
	$manager->persist($country66);
	$this->addReference('country-EG', $country66);

	$country67 = new Country();
	$country67->setIsoCode("SV");
	$country67->setLabel("EL SALVADOR");
	$manager->persist($country67);
	$this->addReference('country-SV', $country67);

	$country68 = new Country();
	$country68->setIsoCode("AE");
	$country68->setLabel("ÉMIRATS ARABES UNIS");
	$manager->persist($country68);
	$this->addReference('country-AE', $country68);

	$country69 = new Country();
	$country69->setIsoCode("EC");
	$country69->setLabel("ÉQUATEUR");
	$manager->persist($country69);
	$this->addReference('country-EC', $country69);

	$country70 = new Country();
	$country70->setIsoCode("ER");
	$country70->setLabel("ÉRYTHRÉE");
	$manager->persist($country70);
	$this->addReference('country-ER', $country70);

	$country71 = new Country();
	$country71->setIsoCode("ES");
	$country71->setLabel("ESPAGNE");
	$manager->persist($country71);
	$this->addReference('country-ES', $country71);

	$country72 = new Country();
	$country72->setIsoCode("EE");
	$country72->setLabel("ESTONIE");
	$manager->persist($country72);
	$this->addReference('country-EE', $country72);

	$country73 = new Country();
	$country73->setIsoCode("US");
	$country73->setLabel("ÉTATS-UNIS");
	$manager->persist($country73);
	$this->addReference('country-US', $country73);

	$country74 = new Country();
	$country74->setIsoCode("ET");
	$country74->setLabel("ÉTHIOPIE");
	$manager->persist($country74);
	$this->addReference('country-ET', $country74);

	$country75 = new Country();
	$country75->setIsoCode("FK");
	$country75->setLabel("FALKLAND, ÎLES (MALVINAS)");
	$manager->persist($country75);
	$this->addReference('country-FK', $country75);

	$country76 = new Country();
	$country76->setIsoCode("FO");
	$country76->setLabel("FÉROÉ, ÎLES");
	$manager->persist($country76);
	$this->addReference('country-FO', $country76);

	$country77 = new Country();
	$country77->setIsoCode("FJ");
	$country77->setLabel("FIDJI");
	$manager->persist($country77);
	$this->addReference('country-FJ', $country77);

	$country78 = new Country();
	$country78->setIsoCode("FI");
	$country78->setLabel("FINLANDE");
	$manager->persist($country78);
	$this->addReference('country-FI', $country78);

	$country79 = new Country();
	$country79->setIsoCode("FR");
	$country79->setLabel("FRANCE");
	$manager->persist($country79);
	$this->addReference('country-FR', $country79);

	$country80 = new Country();
	$country80->setIsoCode("GA");
	$country80->setLabel("GABON");
	$manager->persist($country80);
	$this->addReference('country-GA', $country80);

	$country81 = new Country();
	$country81->setIsoCode("GM");
	$country81->setLabel("GAMBIE");
	$manager->persist($country81);
	$this->addReference('country-GM', $country81);

	$country82 = new Country();
	$country82->setIsoCode("GE");
	$country82->setLabel("GÉORGIE");
	$manager->persist($country82);
	$this->addReference('country-GE', $country82);

	$country83 = new Country();
	$country83->setIsoCode("GS");
	$country83->setLabel("GÉORGIE DU SUD-ET-LES ÎLES SANDWICH DU SUD");
	$manager->persist($country83);
	$this->addReference('country-GS', $country83);

	$country84 = new Country();
	$country84->setIsoCode("GH");
	$country84->setLabel("GHANA");
	$manager->persist($country84);
	$this->addReference('country-GH', $country84);

	$country85 = new Country();
	$country85->setIsoCode("GI");
	$country85->setLabel("GIBRALTAR");
	$manager->persist($country85);
	$this->addReference('country-GI', $country85);

	$country86 = new Country();
	$country86->setIsoCode("GR");
	$country86->setLabel("GRÈCE");
	$manager->persist($country86);
	$this->addReference('country-GR', $country86);

	$country87 = new Country();
	$country87->setIsoCode("GD");
	$country87->setLabel("GRENADE");
	$manager->persist($country87);
	$this->addReference('country-GD', $country87);

	$country88 = new Country();
	$country88->setIsoCode("GL");
	$country88->setLabel("GROENLAND");
	$manager->persist($country88);
	$this->addReference('country-GL', $country88);

	$country89 = new Country();
	$country89->setIsoCode("GP");
	$country89->setLabel("GUADELOUPE");
	$manager->persist($country89);
	$this->addReference('country-GP', $country89);

	$country90 = new Country();
	$country90->setIsoCode("GU");
	$country90->setLabel("GUAM");
	$manager->persist($country90);
	$this->addReference('country-GU', $country90);

	$country91 = new Country();
	$country91->setIsoCode("GT");
	$country91->setLabel("GUATEMALA");
	$manager->persist($country91);
	$this->addReference('country-GT', $country91);

	$country92 = new Country();
	$country92->setIsoCode("GG");
	$country92->setLabel("GUERNESEY");
	$manager->persist($country92);
	$this->addReference('country-GG', $country92);

	$country93 = new Country();
	$country93->setIsoCode("GN");
	$country93->setLabel("GUINÉE");
	$manager->persist($country93);
	$this->addReference('country-GN', $country93);

	$country94 = new Country();
	$country94->setIsoCode("GW");
	$country94->setLabel("GUINÉE-BISSAU");
	$manager->persist($country94);
	$this->addReference('country-GW', $country94);

	$country95 = new Country();
	$country95->setIsoCode("GQ");
	$country95->setLabel("GUINÉE ÉQUATORIALE");
	$manager->persist($country95);
	$this->addReference('country-GQ', $country95);

	$country96 = new Country();
	$country96->setIsoCode("GY");
	$country96->setLabel("GUYANA");
	$manager->persist($country96);
	$this->addReference('country-GY', $country96);

	$country97 = new Country();
	$country97->setIsoCode("GF");
	$country97->setLabel("GUYANE FRANÇAISE");
	$manager->persist($country97);
	$this->addReference('country-GF', $country97);

	$country98 = new Country();
	$country98->setIsoCode("HT");
	$country98->setLabel("HAÏTI");
	$manager->persist($country98);
	$this->addReference('country-HT', $country98);

	$country99 = new Country();
	$country99->setIsoCode("HM");
	$country99->setLabel("HEARD-ET-ÎLES MACDONALD, ÎLE");
	$manager->persist($country99);
	$this->addReference('country-HM', $country99);

	$country100 = new Country();
	$country100->setIsoCode("HN");
	$country100->setLabel("HONDURAS");
	$manager->persist($country100);
	$this->addReference('country-HN', $country100);

	$country101 = new Country();
	$country101->setIsoCode("HK");
	$country101->setLabel("HONG KONG");
	$manager->persist($country101);
	$this->addReference('country-HK', $country101);

	$country102 = new Country();
	$country102->setIsoCode("HU");
	$country102->setLabel("HONGRIE");
	$manager->persist($country102);
	$this->addReference('country-HU', $country102);

	$country103 = new Country();
	$country103->setIsoCode("IM");
	$country103->setLabel("ÎLE DE MAN");
	$manager->persist($country103);
	$this->addReference('country-IM', $country103);

	$country104 = new Country();
	$country104->setIsoCode("UM");
	$country104->setLabel("ÎLES MINEURES ÉLOIGNÉES DES ÉTATS-UNIS");
	$manager->persist($country104);
	$this->addReference('country-UM', $country104);

	$country105 = new Country();
	$country105->setIsoCode("VG");
	$country105->setLabel("ÎLES VIERGES BRITANNIQUES");
	$manager->persist($country105);
	$this->addReference('country-VG', $country105);

	$country106 = new Country();
	$country106->setIsoCode("VI");
	$country106->setLabel("ÎLES VIERGES DES ÉTATS-UNIS");
	$manager->persist($country106);
	$this->addReference('country-VI', $country106);

	$country107 = new Country();
	$country107->setIsoCode("IN");
	$country107->setLabel("INDE");
	$manager->persist($country107);
	$this->addReference('country-IN', $country107);

	$country108 = new Country();
	$country108->setIsoCode("ID");
	$country108->setLabel("INDONÉSIE");
	$manager->persist($country108);
	$this->addReference('country-ID', $country108);

	$country109 = new Country();
	$country109->setIsoCode("IR");
	$country109->setLabel("IRAN, RÉPUBLIQUE ISLAMIQUE D'");
	$manager->persist($country109);
	$this->addReference('country-IR', $country109);

	$country110 = new Country();
	$country110->setIsoCode("IQ");
	$country110->setLabel("IRAQ");
	$manager->persist($country110);
	$this->addReference('country-IQ', $country110);

	$country111 = new Country();
	$country111->setIsoCode("IE");
	$country111->setLabel("IRLANDE");
	$manager->persist($country111);
	$this->addReference('country-IE', $country111);

	$country112 = new Country();
	$country112->setIsoCode("IS");
	$country112->setLabel("ISLANDE");
	$manager->persist($country112);
	$this->addReference('country-IS', $country112);

	$country113 = new Country();
	$country113->setIsoCode("IL");
	$country113->setLabel("ISRAËL");
	$manager->persist($country113);
	$this->addReference('country-IL', $country113);

	$country114 = new Country();
	$country114->setIsoCode("IT");
	$country114->setLabel("ITALIE");
	$manager->persist($country114);
	$this->addReference('country-IT', $country114);

	$country115 = new Country();
	$country115->setIsoCode("JM");
	$country115->setLabel("JAMAÏQUE");
	$manager->persist($country115);
	$this->addReference('country-JM', $country115);

	$country116 = new Country();
	$country116->setIsoCode("JP");
	$country116->setLabel("JAPON");
	$manager->persist($country116);
	$this->addReference('country-JP', $country116);

	$country117 = new Country();
	$country117->setIsoCode("JE");
	$country117->setLabel("JERSEY");
	$manager->persist($country117);
	$this->addReference('country-JE', $country117);

	$country118 = new Country();
	$country118->setIsoCode("JO");
	$country118->setLabel("JORDANIE");
	$manager->persist($country118);
	$this->addReference('country-JO', $country118);

	$country119 = new Country();
	$country119->setIsoCode("KZ");
	$country119->setLabel("KAZAKHSTAN");
	$manager->persist($country119);
	$this->addReference('country-KZ', $country119);

	$country120 = new Country();
	$country120->setIsoCode("KE");
	$country120->setLabel("KENYA");
	$manager->persist($country120);
	$this->addReference('country-KE', $country120);

	$country121 = new Country();
	$country121->setIsoCode("KG");
	$country121->setLabel("KIRGHIZISTAN");
	$manager->persist($country121);
	$this->addReference('country-KG', $country121);

	$country122 = new Country();
	$country122->setIsoCode("KI");
	$country122->setLabel("KIRIBATI");
	$manager->persist($country122);
	$this->addReference('country-KI', $country122);

	$country123 = new Country();
	$country123->setIsoCode("KW");
	$country123->setLabel("KOWEÏT");
	$manager->persist($country123);
	$this->addReference('country-KW', $country123);

	$country124 = new Country();
	$country124->setIsoCode("LA");
	$country124->setLabel("LAO, RÉPUBLIQUE DÉMOCRATIQUE POPULAIRE");
	$manager->persist($country124);
	$this->addReference('country-LA', $country124);

	$country125 = new Country();
	$country125->setIsoCode("LS");
	$country125->setLabel("LESOTHO");
	$manager->persist($country125);
	$this->addReference('country-LS', $country125);

	$country126 = new Country();
	$country126->setIsoCode("LV");
	$country126->setLabel("LETTONIE");
	$manager->persist($country126);
	$this->addReference('country-LV', $country126);

	$country127 = new Country();
	$country127->setIsoCode("LB");
	$country127->setLabel("LIBAN");
	$manager->persist($country127);
	$this->addReference('country-LB', $country127);

	$country128 = new Country();
	$country128->setIsoCode("LR");
	$country128->setLabel("LIBÉRIA");
	$manager->persist($country128);
	$this->addReference('country-LR', $country128);

	$country129 = new Country();
	$country129->setIsoCode("LY");
	$country129->setLabel("LIBYE");
	$manager->persist($country129);
	$this->addReference('country-LY', $country129);

	$country130 = new Country();
	$country130->setIsoCode("LI");
	$country130->setLabel("LIECHTENSTEIN");
	$manager->persist($country130);
	$this->addReference('country-LI', $country130);

	$country131 = new Country();
	$country131->setIsoCode("LT");
	$country131->setLabel("LITUANIE");
	$manager->persist($country131);
	$this->addReference('country-LT', $country131);

	$country132 = new Country();
	$country132->setIsoCode("LU");
	$country132->setLabel("LUXEMBOURG");
	$manager->persist($country132);
	$this->addReference('country-LU', $country132);

	$country133 = new Country();
	$country133->setIsoCode("MO");
	$country133->setLabel("MACAO");
	$manager->persist($country133);
	$this->addReference('country-MO', $country133);

	$country134 = new Country();
	$country134->setIsoCode("MK");
	$country134->setLabel("MACÉDOINE, L'EX-RÉPUBLIQUE YOUGOSLAVE DE");
	$manager->persist($country134);
	$this->addReference('country-MK', $country134);

	$country135 = new Country();
	$country135->setIsoCode("MG");
	$country135->setLabel("MADAGASCAR");
	$manager->persist($country135);
	$this->addReference('country-MG', $country135);

	$country136 = new Country();
	$country136->setIsoCode("MY");
	$country136->setLabel("MALAISIE");
	$manager->persist($country136);
	$this->addReference('country-MY', $country136);

	$country137 = new Country();
	$country137->setIsoCode("MW");
	$country137->setLabel("MALAWI");
	$manager->persist($country137);
	$this->addReference('country-MW', $country137);

	$country138 = new Country();
	$country138->setIsoCode("MV");
	$country138->setLabel("MALDIVES");
	$manager->persist($country138);
	$this->addReference('country-MV', $country138);

	$country139 = new Country();
	$country139->setIsoCode("ML");
	$country139->setLabel("MALI");
	$manager->persist($country139);
	$this->addReference('country-ML', $country139);

	$country140 = new Country();
	$country140->setIsoCode("MT");
	$country140->setLabel("MALTE");
	$manager->persist($country140);
	$this->addReference('country-MT', $country140);

	$country141 = new Country();
	$country141->setIsoCode("MP");
	$country141->setLabel("MARIANNES DU NORD, ÎLES");
	$manager->persist($country141);
	$this->addReference('country-MP', $country141);

	$country142 = new Country();
	$country142->setIsoCode("MA");
	$country142->setLabel("MAROC");
	$manager->persist($country142);
	$this->addReference('country-MA', $country142);

	$country143 = new Country();
	$country143->setIsoCode("MH");
	$country143->setLabel("MARSHALL, ÎLES");
	$manager->persist($country143);
	$this->addReference('country-MH', $country143);

	$country144 = new Country();
	$country144->setIsoCode("MQ");
	$country144->setLabel("MARTINIQUE");
	$manager->persist($country144);
	$this->addReference('country-MQ', $country144);

	$country145 = new Country();
	$country145->setIsoCode("MU");
	$country145->setLabel("MAURICE");
	$manager->persist($country145);
	$this->addReference('country-MU', $country145);

	$country146 = new Country();
	$country146->setIsoCode("MR");
	$country146->setLabel("MAURITANIE");
	$manager->persist($country146);
	$this->addReference('country-MR', $country146);

	$country147 = new Country();
	$country147->setIsoCode("YT");
	$country147->setLabel("MAYOTTE");
	$manager->persist($country147);
	$this->addReference('country-YT', $country147);

	$country148 = new Country();
	$country148->setIsoCode("MX");
	$country148->setLabel("MEXIQUE");
	$manager->persist($country148);
	$this->addReference('country-MX', $country148);

	$country149 = new Country();
	$country149->setIsoCode("FM");
	$country149->setLabel("MICRONÉSIE, ÉTATS FÉDÉRÉS DE");
	$manager->persist($country149);
	$this->addReference('country-FM', $country149);

	$country150 = new Country();
	$country150->setIsoCode("MD");
	$country150->setLabel("MOLDOVA, RÉPUBLIQUE DE");
	$manager->persist($country150);
	$this->addReference('country-MD', $country150);

	$country151 = new Country();
	$country151->setIsoCode("MC");
	$country151->setLabel("MONACO");
	$manager->persist($country151);
	$this->addReference('country-MC', $country151);

	$country152 = new Country();
	$country152->setIsoCode("MN");
	$country152->setLabel("MONGOLIE");
	$manager->persist($country152);
	$this->addReference('country-MN', $country152);

	$country153 = new Country();
	$country153->setIsoCode("ME");
	$country153->setLabel("MONTÉNÉGRO");
	$manager->persist($country153);
	$this->addReference('country-ME', $country153);

	$country154 = new Country();
	$country154->setIsoCode("MS");
	$country154->setLabel("MONTSERRAT");
	$manager->persist($country154);
	$this->addReference('country-MS', $country154);

	$country155 = new Country();
	$country155->setIsoCode("MZ");
	$country155->setLabel("MOZAMBIQUE");
	$manager->persist($country155);
	$this->addReference('country-MZ', $country155);

	$country156 = new Country();
	$country156->setIsoCode("MM");
	$country156->setLabel("MYANMAR");
	$manager->persist($country156);
	$this->addReference('country-MM', $country156);

	$country157 = new Country();
	$country157->setIsoCode("NA");
	$country157->setLabel("NAMIBIE");
	$manager->persist($country157);
	$this->addReference('country-NA', $country157);

	$country158 = new Country();
	$country158->setIsoCode("NR");
	$country158->setLabel("NAURU");
	$manager->persist($country158);
	$this->addReference('country-NR', $country158);

	$country159 = new Country();
	$country159->setIsoCode("NP");
	$country159->setLabel("NÉPAL");
	$manager->persist($country159);
	$this->addReference('country-NP', $country159);

	$country160 = new Country();
	$country160->setIsoCode("NI");
	$country160->setLabel("NICARAGUA");
	$manager->persist($country160);
	$this->addReference('country-NI', $country160);

	$country161 = new Country();
	$country161->setIsoCode("NE");
	$country161->setLabel("NIGER");
	$manager->persist($country161);
	$this->addReference('country-NE', $country161);

	$country162 = new Country();
	$country162->setIsoCode("NG");
	$country162->setLabel("NIGÉRIA");
	$manager->persist($country162);
	$this->addReference('country-NG', $country162);

	$country163 = new Country();
	$country163->setIsoCode("NU");
	$country163->setLabel("NIUÉ");
	$manager->persist($country163);
	$this->addReference('country-NU', $country163);

	$country164 = new Country();
	$country164->setIsoCode("NF");
	$country164->setLabel("NORFOLK, ÎLE");
	$manager->persist($country164);
	$this->addReference('country-NF', $country164);

	$country165 = new Country();
	$country165->setIsoCode("NO");
	$country165->setLabel("NORVÈGE");
	$manager->persist($country165);
	$this->addReference('country-NO', $country165);

	$country166 = new Country();
	$country166->setIsoCode("NC");
	$country166->setLabel("NOUVELLE-CALÉDONIE");
	$manager->persist($country166);
	$this->addReference('country-NC', $country166);

	$country167 = new Country();
	$country167->setIsoCode("NZ");
	$country167->setLabel("NOUVELLE-ZÉLANDE");
	$manager->persist($country167);
	$this->addReference('country-NZ', $country167);

	$country168 = new Country();
	$country168->setIsoCode("IO");
	$country168->setLabel("OCÉAN INDIEN, TERRITOIRE BRITANNIQUE DE L'");
	$manager->persist($country168);
	$this->addReference('country-IO', $country168);

	$country169 = new Country();
	$country169->setIsoCode("OM");
	$country169->setLabel("OMAN");
	$manager->persist($country169);
	$this->addReference('country-OM', $country169);

	$country170 = new Country();
	$country170->setIsoCode("UG");
	$country170->setLabel("OUGANDA");
	$manager->persist($country170);
	$this->addReference('country-UG', $country170);

	$country171 = new Country();
	$country171->setIsoCode("UZ");
	$country171->setLabel("OUZBÉKISTAN");
	$manager->persist($country171);
	$this->addReference('country-UZ', $country171);

	$country172 = new Country();
	$country172->setIsoCode("PK");
	$country172->setLabel("PAKISTAN");
	$manager->persist($country172);
	$this->addReference('country-PK', $country172);

	$country173 = new Country();
	$country173->setIsoCode("PW");
	$country173->setLabel("PALAOS");
	$manager->persist($country173);
	$this->addReference('country-PW', $country173);

	$country174 = new Country();
	$country174->setIsoCode("PS");
	$country174->setLabel("PALESTINIEN OCCUPÉ, TERRITOIRE");
	$manager->persist($country174);
	$this->addReference('country-PS', $country174);

	$country175 = new Country();
	$country175->setIsoCode("PA");
	$country175->setLabel("PANAMA");
	$manager->persist($country175);
	$this->addReference('country-PA', $country175);

	$country176 = new Country();
	$country176->setIsoCode("PG");
	$country176->setLabel("PAPOUASIE-NOUVELLE-GUINÉE");
	$manager->persist($country176);
	$this->addReference('country-PG', $country176);

	$country177 = new Country();
	$country177->setIsoCode("PY");
	$country177->setLabel("PARAGUAY");
	$manager->persist($country177);
	$this->addReference('country-PY', $country177);

	$country178 = new Country();
	$country178->setIsoCode("NL");
	$country178->setLabel("PAYS-BAS");
	$manager->persist($country178);
	$this->addReference('country-NL', $country178);

	$country179 = new Country();
	$country179->setIsoCode("PE");
	$country179->setLabel("PÉROU");
	$manager->persist($country179);
	$this->addReference('country-PE', $country179);

	$country180 = new Country();
	$country180->setIsoCode("PH");
	$country180->setLabel("PHILIPPINES");
	$manager->persist($country180);
	$this->addReference('country-PH', $country180);

	$country181 = new Country();
	$country181->setIsoCode("PN");
	$country181->setLabel("PITCAIRN");
	$manager->persist($country181);
	$this->addReference('country-PN', $country181);

	$country182 = new Country();
	$country182->setIsoCode("PL");
	$country182->setLabel("POLOGNE");
	$manager->persist($country182);
	$this->addReference('country-PL', $country182);

	$country183 = new Country();
	$country183->setIsoCode("PF");
	$country183->setLabel("POLYNÉSIE FRANÇAISE");
	$manager->persist($country183);
	$this->addReference('country-PF', $country183);

	$country184 = new Country();
	$country184->setIsoCode("PR");
	$country184->setLabel("PORTO RICO");
	$manager->persist($country184);
	$this->addReference('country-PR', $country184);

	$country185 = new Country();
	$country185->setIsoCode("PT");
	$country185->setLabel("PORTUGAL");
	$manager->persist($country185);
	$this->addReference('country-PT', $country185);

	$country186 = new Country();
	$country186->setIsoCode("QA");
	$country186->setLabel("QATAR");
	$manager->persist($country186);
	$this->addReference('country-QA', $country186);

	$country187 = new Country();
	$country187->setIsoCode("RE");
	$country187->setLabel("RÉUNION");
	$manager->persist($country187);
	$this->addReference('country-RE', $country187);

	$country188 = new Country();
	$country188->setIsoCode("RO");
	$country188->setLabel("ROUMANIE");
	$manager->persist($country188);
	$this->addReference('country-RO', $country188);

	$country189 = new Country();
	$country189->setIsoCode("GB");
	$country189->setLabel("ROYAUME-UNI");
	$manager->persist($country189);
	$this->addReference('country-GB', $country189);

	$country190 = new Country();
	$country190->setIsoCode("RU");
	$country190->setLabel("RUSSIE, FÉDÉRATION DE");
	$manager->persist($country190);
	$this->addReference('country-RU', $country190);

	$country191 = new Country();
	$country191->setIsoCode("RW");
	$country191->setLabel("RWANDA");
	$manager->persist($country191);
	$this->addReference('country-RW', $country191);

	$country192 = new Country();
	$country192->setIsoCode("EH");
	$country192->setLabel("SAHARA OCCIDENTAL");
	$manager->persist($country192);
	$this->addReference('country-EH', $country192);

	$country193 = new Country();
	$country193->setIsoCode("BL");
	$country193->setLabel("SAINT-BARTHÉLEMY");
	$manager->persist($country193);
	$this->addReference('country-BL', $country193);

	$country194 = new Country();
	$country194->setIsoCode("SH");
	$country194->setLabel("SAINTE-HÉLÈNE, ASCENSION ET TRISTAN DA CUNHA");
	$manager->persist($country194);
	$this->addReference('country-SH', $country194);

	$country195 = new Country();
	$country195->setIsoCode("LC");
	$country195->setLabel("SAINTE-LUCIE");
	$manager->persist($country195);
	$this->addReference('country-LC', $country195);

	$country196 = new Country();
	$country196->setIsoCode("KN");
	$country196->setLabel("SAINT-KITTS-ET-NEVIS");
	$manager->persist($country196);
	$this->addReference('country-KN', $country196);

	$country197 = new Country();
	$country197->setIsoCode("SM");
	$country197->setLabel("SAINT-MARIN");
	$manager->persist($country197);
	$this->addReference('country-SM', $country197);

	$country198 = new Country();
	$country198->setIsoCode("MF");
	$country198->setLabel("SAINT-MARTIN(PARTIE FRANÇAISE)");
	$manager->persist($country198);
	$this->addReference('country-MF', $country198);

	$country199 = new Country();
	$country199->setIsoCode("SX");
	$country199->setLabel("SAINT-MARTIN (PARTIE NÉERLANDAISE)");
	$manager->persist($country199);
	$this->addReference('country-SX', $country199);

	$country200 = new Country();
	$country200->setIsoCode("PM");
	$country200->setLabel("SAINT-PIERRE-ET-MIQUELON");
	$manager->persist($country200);
	$this->addReference('country-PM', $country200);

	$country201 = new Country();
	$country201->setIsoCode("VA");
	$country201->setLabel("SAINT-SIÈGE (ÉTAT DE LA CITÉ DU VATICAN)");
	$manager->persist($country201);
	$this->addReference('country-VA', $country201);

	$country202 = new Country();
	$country202->setIsoCode("VC");
	$country202->setLabel("SAINT-VINCENT-ET-LES GRENADINES");
	$manager->persist($country202);
	$this->addReference('country-VC', $country202);

	$country203 = new Country();
	$country203->setIsoCode("SB");
	$country203->setLabel("SALOMON, ÎLES");
	$manager->persist($country203);
	$this->addReference('country-SB', $country203);

	$country204 = new Country();
	$country204->setIsoCode("WS");
	$country204->setLabel("SAMOA");
	$manager->persist($country204);
	$this->addReference('country-WS', $country204);

	$country205 = new Country();
	$country205->setIsoCode("AS");
	$country205->setLabel("SAMOA AMÉRICAINES");
	$manager->persist($country205);
	$this->addReference('country-AS', $country205);

	$country206 = new Country();
	$country206->setIsoCode("ST");
	$country206->setLabel("SAO TOMÉ-ET-PRINCIPE");
	$manager->persist($country206);
	$this->addReference('country-ST', $country206);

	$country207 = new Country();
	$country207->setIsoCode("SN");
	$country207->setLabel("SÉNÉGAL");
	$manager->persist($country207);
	$this->addReference('country-SN', $country207);

	$country208 = new Country();
	$country208->setIsoCode("RS");
	$country208->setLabel("SERBIE");
	$manager->persist($country208);
	$this->addReference('country-RS', $country208);

	$country209 = new Country();
	$country209->setIsoCode("SC");
	$country209->setLabel("SEYCHELLES");
	$manager->persist($country209);
	$this->addReference('country-SC', $country209);

	$country210 = new Country();
	$country210->setIsoCode("SL");
	$country210->setLabel("SIERRA LEONE");
	$manager->persist($country210);
	$this->addReference('country-SL', $country210);

	$country211 = new Country();
	$country211->setIsoCode("SG");
	$country211->setLabel("SINGAPOUR");
	$manager->persist($country211);
	$this->addReference('country-SG', $country211);

	$country212 = new Country();
	$country212->setIsoCode("SK");
	$country212->setLabel("SLOVAQUIE");
	$manager->persist($country212);
	$this->addReference('country-SK', $country212);

	$country213 = new Country();
	$country213->setIsoCode("SI");
	$country213->setLabel("SLOVÉNIE");
	$manager->persist($country213);
	$this->addReference('country-SI', $country213);

	$country214 = new Country();
	$country214->setIsoCode("SO");
	$country214->setLabel("SOMALIE");
	$manager->persist($country214);
	$this->addReference('country-SO', $country214);

	$country215 = new Country();
	$country215->setIsoCode("SD");
	$country215->setLabel("SOUDAN");
	$manager->persist($country215);
	$this->addReference('country-SD', $country215);

	$country216 = new Country();
	$country216->setIsoCode("SS");
	$country216->setLabel("SOUDAN DU SUD");
	$manager->persist($country216);
	$this->addReference('country-SS', $country216);

	$country217 = new Country();
	$country217->setIsoCode("LK");
	$country217->setLabel("SRI LANKA");
	$manager->persist($country217);
	$this->addReference('country-LK', $country217);

	$country218 = new Country();
	$country218->setIsoCode("SE");
	$country218->setLabel("SUÈDE");
	$manager->persist($country218);
	$this->addReference('country-SE', $country218);

	$country219 = new Country();
	$country219->setIsoCode("CH");
	$country219->setLabel("SUISSE");
	$manager->persist($country219);
	$this->addReference('country-CH', $country219);

	$country220 = new Country();
	$country220->setIsoCode("SR");
	$country220->setLabel("SURINAME");
	$manager->persist($country220);
	$this->addReference('country-SR', $country220);

	$country221 = new Country();
	$country221->setIsoCode("SJ");
	$country221->setLabel("SVALBARD ET ÎLE JAN MAYEN");
	$manager->persist($country221);
	$this->addReference('country-SJ', $country221);

	$country222 = new Country();
	$country222->setIsoCode("SZ");
	$country222->setLabel("SWAZILAND");
	$manager->persist($country222);
	$this->addReference('country-SZ', $country222);

	$country223 = new Country();
	$country223->setIsoCode("SY");
	$country223->setLabel("SYRIENNE, RÉPUBLIQUE ARABE");
	$manager->persist($country223);
	$this->addReference('country-SY', $country223);

	$country224 = new Country();
	$country224->setIsoCode("TJ");
	$country224->setLabel("TADJIKISTAN");
	$manager->persist($country224);
	$this->addReference('country-TJ', $country224);

	$country225 = new Country();
	$country225->setIsoCode("TW");
	$country225->setLabel("TAÏWAN, PROVINCE DE CHINE");
	$manager->persist($country225);
	$this->addReference('country-TW', $country225);

	$country226 = new Country();
	$country226->setIsoCode("TZ");
	$country226->setLabel("TANZANIE, RÉPUBLIQUE-UNIE DE");
	$manager->persist($country226);
	$this->addReference('country-TZ', $country226);

	$country227 = new Country();
	$country227->setIsoCode("TD");
	$country227->setLabel("TCHAD");
	$manager->persist($country227);
	$this->addReference('country-TD', $country227);

	$country228 = new Country();
	$country228->setIsoCode("CZ");
	$country228->setLabel("TCHÈQUE, RÉPUBLIQUE");
	$manager->persist($country228);
	$this->addReference('country-CZ', $country228);

	$country229 = new Country();
	$country229->setIsoCode("TF");
	$country229->setLabel("TERRES AUSTRALES FRANÇAISES");
	$manager->persist($country229);
	$this->addReference('country-TF', $country229);

	$country230 = new Country();
	$country230->setIsoCode("TH");
	$country230->setLabel("THAÏLANDE");
	$manager->persist($country230);
	$this->addReference('country-TH', $country230);

	$country231 = new Country();
	$country231->setIsoCode("TL");
	$country231->setLabel("TIMOR-LESTE");
	$manager->persist($country231);
	$this->addReference('country-TL', $country231);

	$country232 = new Country();
	$country232->setIsoCode("TG");
	$country232->setLabel("TOGO");
	$manager->persist($country232);
	$this->addReference('country-TG', $country232);

	$country233 = new Country();
	$country233->setIsoCode("TK");
	$country233->setLabel("TOKELAU");
	$manager->persist($country233);
	$this->addReference('country-TK', $country233);

	$country234 = new Country();
	$country234->setIsoCode("TO");
	$country234->setLabel("TONGA");
	$manager->persist($country234);
	$this->addReference('country-TO', $country234);

	$country235 = new Country();
	$country235->setIsoCode("TT");
	$country235->setLabel("TRINITÉ-ET-TOBAGO");
	$manager->persist($country235);
	$this->addReference('country-TT', $country235);

	$country236 = new Country();
	$country236->setIsoCode("TN");
	$country236->setLabel("TUNISIE");
	$manager->persist($country236);
	$this->addReference('country-TN', $country236);

	$country237 = new Country();
	$country237->setIsoCode("TM");
	$country237->setLabel("TURKMÉNISTAN");
	$manager->persist($country237);
	$this->addReference('country-TM', $country237);

	$country238 = new Country();
	$country238->setIsoCode("TC");
	$country238->setLabel("TURKS-ET-CAÏCOS, ÎLES");
	$manager->persist($country238);
	$this->addReference('country-TC', $country238);

	$country239 = new Country();
	$country239->setIsoCode("TR");
	$country239->setLabel("TURQUIE");
	$manager->persist($country239);
	$this->addReference('country-TR', $country239);

	$country240 = new Country();
	$country240->setIsoCode("TV");
	$country240->setLabel("TUVALU");
	$manager->persist($country240);
	$this->addReference('country-TV', $country240);

	$country241 = new Country();
	$country241->setIsoCode("UA");
	$country241->setLabel("UKRAINE");
	$manager->persist($country241);
	$this->addReference('country-UA', $country241);

	$country242 = new Country();
	$country242->setIsoCode("UY");
	$country242->setLabel("URUGUAY");
	$manager->persist($country242);
	$this->addReference('country-UY', $country242);

	$country243 = new Country();
	$country243->setIsoCode("VU");
	$country243->setLabel("VANUATU");
	$manager->persist($country243);
	$this->addReference('country-VU', $country243);

	$country244 = new Country();
	$country244->setIsoCode("VE");
	$country244->setLabel("VENEZUELA, RÉPUBLIQUE BOLIVARIENNE DU");
	$manager->persist($country244);
	$this->addReference('country-VE', $country244);

	$country245 = new Country();
	$country245->setIsoCode("VN");
	$country245->setLabel("VIET NAM");
	$manager->persist($country245);
	$this->addReference('country-VN', $country245);

	$country246 = new Country();
	$country246->setIsoCode("WF");
	$country246->setLabel("WALLIS ET FUTUNA");
	$manager->persist($country246);
	$this->addReference('country-WF', $country246);

	$country247 = new Country();
	$country247->setIsoCode("YE");
	$country247->setLabel("YÉMEN");
	$manager->persist($country247);
	$this->addReference('country-YE', $country247);

	$country248 = new Country();
	$country248->setIsoCode("ZM");
	$country248->setLabel("ZAMBIE");
	$manager->persist($country248);
	$this->addReference('country-ZM', $country248);

	$country249 = new Country();
	$country249->setIsoCode("ZW");
	$country249->setLabel("ZIMBABWE");
	$manager->persist($country249);
	$this->addReference('country-ZW', $country249);
        
        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }

}

?>
