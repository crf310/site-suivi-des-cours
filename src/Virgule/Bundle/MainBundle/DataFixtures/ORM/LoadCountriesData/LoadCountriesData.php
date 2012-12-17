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

        $country2 = new Country();
        $country2->setIsoCode("ZA");
        $country2->setLabel("AFRIQUE DU SUD");

        $country3 = new Country();
        $country3->setIsoCode("AX");
        $country3->setLabel("ÅLAND, ÎLES");

        $country4 = new Country();
        $country4->setIsoCode("AL");
        $country4->setLabel("ALBANIE");

        $country5 = new Country();
        $country5->setIsoCode("DZ");
        $country5->setLabel("ALGÉRIE");

        $country6 = new Country();
        $country6->setIsoCode("DE");
        $country6->setLabel("ALLEMAGNE");

        $country7 = new Country();
        $country7->setIsoCode("AD");
        $country7->setLabel("ANDORRE");

        $country8 = new Country();
        $country8->setIsoCode("AO");
        $country8->setLabel("ANGOLA");

        $country9 = new Country();
        $country9->setIsoCode("AI");
        $country9->setLabel("ANGUILLA");

        $country10 = new Country();
        $country10->setIsoCode("AQ");
        $country10->setLabel("ANTARCTIQUE");

        $country11 = new Country();
        $country11->setIsoCode("AG");
        $country11->setLabel("ANTIGUA-ET-BARBUDA");

        $country12 = new Country();
        $country12->setIsoCode("SA");
        $country12->setLabel("ARABIE SAOUDITE");

        $country13 = new Country();
        $country13->setIsoCode("AR");
        $country13->setLabel("ARGENTINE");

        $country14 = new Country();
        $country14->setIsoCode("AM");
        $country14->setLabel("ARMÉNIE");

        $country15 = new Country();
        $country15->setIsoCode("AW");
        $country15->setLabel("ARUBA");

        $country16 = new Country();
        $country16->setIsoCode("AU");
        $country16->setLabel("AUSTRALIE");

        $country17 = new Country();
        $country17->setIsoCode("AT");
        $country17->setLabel("AUTRICHE");

        $country18 = new Country();
        $country18->setIsoCode("AZ");
        $country18->setLabel("AZERBAÏDJAN");

        $country19 = new Country();
        $country19->setIsoCode("BS");
        $country19->setLabel("BAHAMAS");

        $country20 = new Country();
        $country20->setIsoCode("BH");
        $country20->setLabel("BAHREÏN");

        $country21 = new Country();
        $country21->setIsoCode("BD");
        $country21->setLabel("BANGLADESH");

        $country22 = new Country();
        $country22->setIsoCode("BB");
        $country22->setLabel("BARBADE");

        $country23 = new Country();
        $country23->setIsoCode("BY");
        $country23->setLabel("BÉLARUS");

        $country24 = new Country();
        $country24->setIsoCode("BE");
        $country24->setLabel("BELGIQUE");

        $country25 = new Country();
        $country25->setIsoCode("BZ");
        $country25->setLabel("BELIZE");

        $country26 = new Country();
        $country26->setIsoCode("BJ");
        $country26->setLabel("BÉNIN");

        $country27 = new Country();
        $country27->setIsoCode("BM");
        $country27->setLabel("BERMUDES");

        $country28 = new Country();
        $country28->setIsoCode("BT");
        $country28->setLabel("BHOUTAN");

        $country29 = new Country();
        $country29->setIsoCode("BO");
        $country29->setLabel("BOLIVIE, l'ÉTAT PLURINATIONAL DE");

        $country30 = new Country();
        $country30->setIsoCode("BQ");
        $country30->setLabel("BONAIRE, SAINT-EUSTACHE ET SABA");

        $country31 = new Country();
        $country31->setIsoCode("BA");
        $country31->setLabel("BOSNIE-HERZÉGOVINE");

        $country32 = new Country();
        $country32->setIsoCode("BW");
        $country32->setLabel("BOTSWANA");

        $country33 = new Country();
        $country33->setIsoCode("BV");
        $country33->setLabel("BOUVET, ÎLE");

        $country34 = new Country();
        $country34->setIsoCode("BR");
        $country34->setLabel("BRÉSIL");

        $country35 = new Country();
        $country35->setIsoCode("BN");
        $country35->setLabel("BRUNEI DARUSSALAM");

        $country36 = new Country();
        $country36->setIsoCode("BG");
        $country36->setLabel("BULGARIE");

        $country37 = new Country();
        $country37->setIsoCode("BF");
        $country37->setLabel("BURKINA FASO");

        $country38 = new Country();
        $country38->setIsoCode("BI");
        $country38->setLabel("BURUNDI");

        $country39 = new Country();
        $country39->setIsoCode("KY");
        $country39->setLabel("CAÏMANS, ÎLES");

        $country40 = new Country();
        $country40->setIsoCode("KH");
        $country40->setLabel("CAMBODGE");

        $country41 = new Country();
        $country41->setIsoCode("CM");
        $country41->setLabel("CAMEROUN");

        $country42 = new Country();
        $country42->setIsoCode("CA");
        $country42->setLabel("CANADA");

        $country43 = new Country();
        $country43->setIsoCode("CV");
        $country43->setLabel("CAP-VERT");

        $country44 = new Country();
        $country44->setIsoCode("CF");
        $country44->setLabel("CENTRAFRICAINE, RÉPUBLIQUE");

        $country45 = new Country();
        $country45->setIsoCode("CL");
        $country45->setLabel("CHILI");

        $country46 = new Country();
        $country46->setIsoCode("CN");
        $country46->setLabel("CHINE");

        $country47 = new Country();
        $country47->setIsoCode("CX");
        $country47->setLabel("CHRISTMAS, ÎLE");

        $country48 = new Country();
        $country48->setIsoCode("CY");
        $country48->setLabel("CHYPRE");

        $country49 = new Country();
        $country49->setIsoCode("CC");
        $country49->setLabel("COCOS (KEELING), ÎLES");

        $country50 = new Country();
        $country50->setIsoCode("CO");
        $country50->setLabel("COLOMBIE");

        $country51 = new Country();
        $country51->setIsoCode("KM");
        $country51->setLabel("COMORES");

        $country52 = new Country();
        $country52->setIsoCode("CG");
        $country52->setLabel("CONGO");

        $country53 = new Country();
        $country53->setIsoCode("CD");
        $country53->setLabel("CONGO, LA RÉPUBLIQUE DÉMOCRATIQUE DU");

        $country54 = new Country();
        $country54->setIsoCode("CK");
        $country54->setLabel("COOK, ÎLES");

        $country55 = new Country();
        $country55->setIsoCode("KR");
        $country55->setLabel("CORÉE, RÉPUBLIQUE DE");

        $country56 = new Country();
        $country56->setIsoCode("KP");
        $country56->setLabel("CORÉE, RÉPUBLIQUE POPULAIRE DÉMOCRATIQUE DE");

        $country57 = new Country();
        $country57->setIsoCode("CR");
        $country57->setLabel("COSTA RICA");

        $country58 = new Country();
        $country58->setIsoCode("CI");
        $country58->setLabel("CÔTE D'IVOIRE");

        $country59 = new Country();
        $country59->setIsoCode("HR");
        $country59->setLabel("CROATIE");

        $country60 = new Country();
        $country60->setIsoCode("CU");
        $country60->setLabel("CUBA");

        $country61 = new Country();
        $country61->setIsoCode("CW");
        $country61->setLabel("CURAÇAO");

        $country62 = new Country();
        $country62->setIsoCode("DK");
        $country62->setLabel("DANEMARK");

        $country63 = new Country();
        $country63->setIsoCode("DJ");
        $country63->setLabel("DJIBOUTI");

        $country64 = new Country();
        $country64->setIsoCode("DO");
        $country64->setLabel("DOMINICAINE, RÉPUBLIQUE");

        $country65 = new Country();
        $country65->setIsoCode("DM");
        $country65->setLabel("DOMINIQUE");

        $country66 = new Country();
        $country66->setIsoCode("EG");
        $country66->setLabel("ÉGYPTE");

        $country67 = new Country();
        $country67->setIsoCode("SV");
        $country67->setLabel("EL SALVADOR");

        $country68 = new Country();
        $country68->setIsoCode("AE");
        $country68->setLabel("ÉMIRATS ARABES UNIS");

        $country69 = new Country();
        $country69->setIsoCode("EC");
        $country69->setLabel("ÉQUATEUR");

        $country70 = new Country();
        $country70->setIsoCode("ER");
        $country70->setLabel("ÉRYTHRÉE");

        $country71 = new Country();
        $country71->setIsoCode("ES");
        $country71->setLabel("ESPAGNE");

        $country72 = new Country();
        $country72->setIsoCode("EE");
        $country72->setLabel("ESTONIE");

        $country73 = new Country();
        $country73->setIsoCode("US");
        $country73->setLabel("ÉTATS-UNIS");

        $country74 = new Country();
        $country74->setIsoCode("ET");
        $country74->setLabel("ÉTHIOPIE");

        $country75 = new Country();
        $country75->setIsoCode("FK");
        $country75->setLabel("FALKLAND, ÎLES (MALVINAS)");

        $country76 = new Country();
        $country76->setIsoCode("FO");
        $country76->setLabel("FÉROÉ, ÎLES");

        $country77 = new Country();
        $country77->setIsoCode("FJ");
        $country77->setLabel("FIDJI");

        $country78 = new Country();
        $country78->setIsoCode("FI");
        $country78->setLabel("FINLANDE");

        $country79 = new Country();
        $country79->setIsoCode("FR");
        $country79->setLabel("FRANCE");

        $country80 = new Country();
        $country80->setIsoCode("GA");
        $country80->setLabel("GABON");

        $country81 = new Country();
        $country81->setIsoCode("GM");
        $country81->setLabel("GAMBIE");

        $country82 = new Country();
        $country82->setIsoCode("GE");
        $country82->setLabel("GÉORGIE");

        $country83 = new Country();
        $country83->setIsoCode("GS");
        $country83->setLabel("GÉORGIE DU SUD-ET-LES ÎLES SANDWICH DU SUD");

        $country84 = new Country();
        $country84->setIsoCode("GH");
        $country84->setLabel("GHANA");

        $country85 = new Country();
        $country85->setIsoCode("GI");
        $country85->setLabel("GIBRALTAR");

        $country86 = new Country();
        $country86->setIsoCode("GR");
        $country86->setLabel("GRÈCE");

        $country87 = new Country();
        $country87->setIsoCode("GD");
        $country87->setLabel("GRENADE");

        $country88 = new Country();
        $country88->setIsoCode("GL");
        $country88->setLabel("GROENLAND");

        $country89 = new Country();
        $country89->setIsoCode("GP");
        $country89->setLabel("GUADELOUPE");

        $country90 = new Country();
        $country90->setIsoCode("GU");
        $country90->setLabel("GUAM");

        $country91 = new Country();
        $country91->setIsoCode("GT");
        $country91->setLabel("GUATEMALA");

        $country92 = new Country();
        $country92->setIsoCode("GG");
        $country92->setLabel("GUERNESEY");

        $country93 = new Country();
        $country93->setIsoCode("GN");
        $country93->setLabel("GUINÉE");

        $country94 = new Country();
        $country94->setIsoCode("GW");
        $country94->setLabel("GUINÉE-BISSAU");

        $country95 = new Country();
        $country95->setIsoCode("GQ");
        $country95->setLabel("GUINÉE ÉQUATORIALE");

        $country96 = new Country();
        $country96->setIsoCode("GY");
        $country96->setLabel("GUYANA");

        $country97 = new Country();
        $country97->setIsoCode("GF");
        $country97->setLabel("GUYANE FRANÇAISE");

        $country98 = new Country();
        $country98->setIsoCode("HT");
        $country98->setLabel("HAÏTI");

        $country99 = new Country();
        $country99->setIsoCode("HM");
        $country99->setLabel("HEARD-ET-ÎLES MACDONALD, ÎLE");

        $country100 = new Country();
        $country100->setIsoCode("HN");
        $country100->setLabel("HONDURAS");

        $country101 = new Country();
        $country101->setIsoCode("HK");
        $country101->setLabel("HONG KONG");

        $country102 = new Country();
        $country102->setIsoCode("HU");
        $country102->setLabel("HONGRIE");

        $country103 = new Country();
        $country103->setIsoCode("IM");
        $country103->setLabel("ÎLE DE MAN");

        $country104 = new Country();
        $country104->setIsoCode("UM");
        $country104->setLabel("ÎLES MINEURES ÉLOIGNÉES DES ÉTATS-UNIS");

        $country105 = new Country();
        $country105->setIsoCode("VG");
        $country105->setLabel("ÎLES VIERGES BRITANNIQUES");

        $country106 = new Country();
        $country106->setIsoCode("VI");
        $country106->setLabel("ÎLES VIERGES DES ÉTATS-UNIS");

        $country107 = new Country();
        $country107->setIsoCode("IN");
        $country107->setLabel("INDE");

        $country108 = new Country();
        $country108->setIsoCode("ID");
        $country108->setLabel("INDONÉSIE");

        $country109 = new Country();
        $country109->setIsoCode("IR");
        $country109->setLabel("IRAN, RÉPUBLIQUE ISLAMIQUE D'");

        $country110 = new Country();
        $country110->setIsoCode("IQ");
        $country110->setLabel("IRAQ");

        $country111 = new Country();
        $country111->setIsoCode("IE");
        $country111->setLabel("IRLANDE");

        $country112 = new Country();
        $country112->setIsoCode("IS");
        $country112->setLabel("ISLANDE");

        $country113 = new Country();
        $country113->setIsoCode("IL");
        $country113->setLabel("ISRAËL");

        $country114 = new Country();
        $country114->setIsoCode("IT");
        $country114->setLabel("ITALIE");

        $country115 = new Country();
        $country115->setIsoCode("JM");
        $country115->setLabel("JAMAÏQUE");

        $country116 = new Country();
        $country116->setIsoCode("JP");
        $country116->setLabel("JAPON");

        $country117 = new Country();
        $country117->setIsoCode("JE");
        $country117->setLabel("JERSEY");

        $country118 = new Country();
        $country118->setIsoCode("JO");
        $country118->setLabel("JORDANIE");

        $country119 = new Country();
        $country119->setIsoCode("KZ");
        $country119->setLabel("KAZAKHSTAN");

        $country120 = new Country();
        $country120->setIsoCode("KE");
        $country120->setLabel("KENYA");

        $country121 = new Country();
        $country121->setIsoCode("KG");
        $country121->setLabel("KIRGHIZISTAN");

        $country122 = new Country();
        $country122->setIsoCode("KI");
        $country122->setLabel("KIRIBATI");

        $country123 = new Country();
        $country123->setIsoCode("KW");
        $country123->setLabel("KOWEÏT");

        $country124 = new Country();
        $country124->setIsoCode("LA");
        $country124->setLabel("LAO, RÉPUBLIQUE DÉMOCRATIQUE POPULAIRE");

        $country125 = new Country();
        $country125->setIsoCode("LS");
        $country125->setLabel("LESOTHO");

        $country126 = new Country();
        $country126->setIsoCode("LV");
        $country126->setLabel("LETTONIE");

        $country127 = new Country();
        $country127->setIsoCode("LB");
        $country127->setLabel("LIBAN");

        $country128 = new Country();
        $country128->setIsoCode("LR");
        $country128->setLabel("LIBÉRIA");

        $country129 = new Country();
        $country129->setIsoCode("LY");
        $country129->setLabel("LIBYE");

        $country130 = new Country();
        $country130->setIsoCode("LI");
        $country130->setLabel("LIECHTENSTEIN");

        $country131 = new Country();
        $country131->setIsoCode("LT");
        $country131->setLabel("LITUANIE");

        $country132 = new Country();
        $country132->setIsoCode("LU");
        $country132->setLabel("LUXEMBOURG");

        $country133 = new Country();
        $country133->setIsoCode("MO");
        $country133->setLabel("MACAO");

        $country134 = new Country();
        $country134->setIsoCode("MK");
        $country134->setLabel("MACÉDOINE, L'EX-RÉPUBLIQUE YOUGOSLAVE DE");

        $country135 = new Country();
        $country135->setIsoCode("MG");
        $country135->setLabel("MADAGASCAR");

        $country136 = new Country();
        $country136->setIsoCode("MY");
        $country136->setLabel("MALAISIE");

        $country137 = new Country();
        $country137->setIsoCode("MW");
        $country137->setLabel("MALAWI");

        $country138 = new Country();
        $country138->setIsoCode("MV");
        $country138->setLabel("MALDIVES");

        $country139 = new Country();
        $country139->setIsoCode("ML");
        $country139->setLabel("MALI");

        $country140 = new Country();
        $country140->setIsoCode("MT");
        $country140->setLabel("MALTE");

        $country141 = new Country();
        $country141->setIsoCode("MP");
        $country141->setLabel("MARIANNES DU NORD, ÎLES");

        $country142 = new Country();
        $country142->setIsoCode("MA");
        $country142->setLabel("MAROC");

        $country143 = new Country();
        $country143->setIsoCode("MH");
        $country143->setLabel("MARSHALL, ÎLES");

        $country144 = new Country();
        $country144->setIsoCode("MQ");
        $country144->setLabel("MARTINIQUE");

        $country145 = new Country();
        $country145->setIsoCode("MU");
        $country145->setLabel("MAURICE");

        $country146 = new Country();
        $country146->setIsoCode("MR");
        $country146->setLabel("MAURITANIE");

        $country147 = new Country();
        $country147->setIsoCode("YT");
        $country147->setLabel("MAYOTTE");

        $country148 = new Country();
        $country148->setIsoCode("MX");
        $country148->setLabel("MEXIQUE");

        $country149 = new Country();
        $country149->setIsoCode("FM");
        $country149->setLabel("MICRONÉSIE, ÉTATS FÉDÉRÉS DE");

        $country150 = new Country();
        $country150->setIsoCode("MD");
        $country150->setLabel("MOLDOVA, RÉPUBLIQUE DE");

        $country151 = new Country();
        $country151->setIsoCode("MC");
        $country151->setLabel("MONACO");

        $country152 = new Country();
        $country152->setIsoCode("MN");
        $country152->setLabel("MONGOLIE");

        $country153 = new Country();
        $country153->setIsoCode("ME");
        $country153->setLabel("MONTÉNÉGRO");

        $country154 = new Country();
        $country154->setIsoCode("MS");
        $country154->setLabel("MONTSERRAT");

        $country155 = new Country();
        $country155->setIsoCode("MZ");
        $country155->setLabel("MOZAMBIQUE");

        $country156 = new Country();
        $country156->setIsoCode("MM");
        $country156->setLabel("MYANMAR");

        $country157 = new Country();
        $country157->setIsoCode("NA");
        $country157->setLabel("NAMIBIE");

        $country158 = new Country();
        $country158->setIsoCode("NR");
        $country158->setLabel("NAURU");

        $country159 = new Country();
        $country159->setIsoCode("NP");
        $country159->setLabel("NÉPAL");

        $country160 = new Country();
        $country160->setIsoCode("NI");
        $country160->setLabel("NICARAGUA");

        $country161 = new Country();
        $country161->setIsoCode("NE");
        $country161->setLabel("NIGER");

        $country162 = new Country();
        $country162->setIsoCode("NG");
        $country162->setLabel("NIGÉRIA");

        $country163 = new Country();
        $country163->setIsoCode("NU");
        $country163->setLabel("NIUÉ");

        $country164 = new Country();
        $country164->setIsoCode("NF");
        $country164->setLabel("NORFOLK, ÎLE");

        $country165 = new Country();
        $country165->setIsoCode("NO");
        $country165->setLabel("NORVÈGE");

        $country166 = new Country();
        $country166->setIsoCode("NC");
        $country166->setLabel("NOUVELLE-CALÉDONIE");

        $country167 = new Country();
        $country167->setIsoCode("NZ");
        $country167->setLabel("NOUVELLE-ZÉLANDE");

        $country168 = new Country();
        $country168->setIsoCode("IO");
        $country168->setLabel("OCÉAN INDIEN, TERRITOIRE BRITANNIQUE DE L'");

        $country169 = new Country();
        $country169->setIsoCode("OM");
        $country169->setLabel("OMAN");

        $country170 = new Country();
        $country170->setIsoCode("UG");
        $country170->setLabel("OUGANDA");

        $country171 = new Country();
        $country171->setIsoCode("UZ");
        $country171->setLabel("OUZBÉKISTAN");

        $country172 = new Country();
        $country172->setIsoCode("PK");
        $country172->setLabel("PAKISTAN");

        $country173 = new Country();
        $country173->setIsoCode("PW");
        $country173->setLabel("PALAOS");

        $country174 = new Country();
        $country174->setIsoCode("PS");
        $country174->setLabel("PALESTINIEN OCCUPÉ, TERRITOIRE");

        $country175 = new Country();
        $country175->setIsoCode("PA");
        $country175->setLabel("PANAMA");

        $country176 = new Country();
        $country176->setIsoCode("PG");
        $country176->setLabel("PAPOUASIE-NOUVELLE-GUINÉE");

        $country177 = new Country();
        $country177->setIsoCode("PY");
        $country177->setLabel("PARAGUAY");

        $country178 = new Country();
        $country178->setIsoCode("NL");
        $country178->setLabel("PAYS-BAS");

        $country179 = new Country();
        $country179->setIsoCode("PE");
        $country179->setLabel("PÉROU");

        $country180 = new Country();
        $country180->setIsoCode("PH");
        $country180->setLabel("PHILIPPINES");

        $country181 = new Country();
        $country181->setIsoCode("PN");
        $country181->setLabel("PITCAIRN");

        $country182 = new Country();
        $country182->setIsoCode("PL");
        $country182->setLabel("POLOGNE");

        $country183 = new Country();
        $country183->setIsoCode("PF");
        $country183->setLabel("POLYNÉSIE FRANÇAISE");

        $country184 = new Country();
        $country184->setIsoCode("PR");
        $country184->setLabel("PORTO RICO");

        $country185 = new Country();
        $country185->setIsoCode("PT");
        $country185->setLabel("PORTUGAL");

        $country186 = new Country();
        $country186->setIsoCode("QA");
        $country186->setLabel("QATAR");

        $country187 = new Country();
        $country187->setIsoCode("RE");
        $country187->setLabel("RÉUNION");

        $country188 = new Country();
        $country188->setIsoCode("RO");
        $country188->setLabel("ROUMANIE");

        $country189 = new Country();
        $country189->setIsoCode("GB");
        $country189->setLabel("ROYAUME-UNI");

        $country190 = new Country();
        $country190->setIsoCode("RU");
        $country190->setLabel("RUSSIE, FÉDÉRATION DE");

        $country191 = new Country();
        $country191->setIsoCode("RW");
        $country191->setLabel("RWANDA");

        $country192 = new Country();
        $country192->setIsoCode("EH");
        $country192->setLabel("SAHARA OCCIDENTAL");

        $country193 = new Country();
        $country193->setIsoCode("BL");
        $country193->setLabel("SAINT-BARTHÉLEMY");

        $country194 = new Country();
        $country194->setIsoCode("SH");
        $country194->setLabel("SAINTE-HÉLÈNE, ASCENSION ET TRISTAN DA CUNHA");

        $country195 = new Country();
        $country195->setIsoCode("LC");
        $country195->setLabel("SAINTE-LUCIE");

        $country196 = new Country();
        $country196->setIsoCode("KN");
        $country196->setLabel("SAINT-KITTS-ET-NEVIS");

        $country197 = new Country();
        $country197->setIsoCode("SM");
        $country197->setLabel("SAINT-MARIN");

        $country198 = new Country();
        $country198->setIsoCode("MF");
        $country198->setLabel("SAINT-MARTIN(PARTIE FRANÇAISE)");

        $country199 = new Country();
        $country199->setIsoCode("SX");
        $country199->setLabel("SAINT-MARTIN (PARTIE NÉERLANDAISE)");

        $country200 = new Country();
        $country200->setIsoCode("PM");
        $country200->setLabel("SAINT-PIERRE-ET-MIQUELON");

        $country201 = new Country();
        $country201->setIsoCode("VA");
        $country201->setLabel("SAINT-SIÈGE (ÉTAT DE LA CITÉ DU VATICAN)");

        $country202 = new Country();
        $country202->setIsoCode("VC");
        $country202->setLabel("SAINT-VINCENT-ET-LES GRENADINES");

        $country203 = new Country();
        $country203->setIsoCode("SB");
        $country203->setLabel("SALOMON, ÎLES");

        $country204 = new Country();
        $country204->setIsoCode("WS");
        $country204->setLabel("SAMOA");

        $country205 = new Country();
        $country205->setIsoCode("AS");
        $country205->setLabel("SAMOA AMÉRICAINES");

        $country206 = new Country();
        $country206->setIsoCode("ST");
        $country206->setLabel("SAO TOMÉ-ET-PRINCIPE");

        $country207 = new Country();
        $country207->setIsoCode("SN");
        $country207->setLabel("SÉNÉGAL");

        $country208 = new Country();
        $country208->setIsoCode("RS");
        $country208->setLabel("SERBIE");

        $country209 = new Country();
        $country209->setIsoCode("SC");
        $country209->setLabel("SEYCHELLES");

        $country210 = new Country();
        $country210->setIsoCode("SL");
        $country210->setLabel("SIERRA LEONE");

        $country211 = new Country();
        $country211->setIsoCode("SG");
        $country211->setLabel("SINGAPOUR");

        $country212 = new Country();
        $country212->setIsoCode("SK");
        $country212->setLabel("SLOVAQUIE");

        $country213 = new Country();
        $country213->setIsoCode("SI");
        $country213->setLabel("SLOVÉNIE");

        $country214 = new Country();
        $country214->setIsoCode("SO");
        $country214->setLabel("SOMALIE");

        $country215 = new Country();
        $country215->setIsoCode("SD");
        $country215->setLabel("SOUDAN");

        $country216 = new Country();
        $country216->setIsoCode("SS");
        $country216->setLabel("SOUDAN DU SUD");

        $country217 = new Country();
        $country217->setIsoCode("LK");
        $country217->setLabel("SRI LANKA");

        $country218 = new Country();
        $country218->setIsoCode("SE");
        $country218->setLabel("SUÈDE");

        $country219 = new Country();
        $country219->setIsoCode("CH");
        $country219->setLabel("SUISSE");

        $country220 = new Country();
        $country220->setIsoCode("SR");
        $country220->setLabel("SURINAME");

        $country221 = new Country();
        $country221->setIsoCode("SJ");
        $country221->setLabel("SVALBARD ET ÎLE JAN MAYEN");

        $country222 = new Country();
        $country222->setIsoCode("SZ");
        $country222->setLabel("SWAZILAND");

        $country223 = new Country();
        $country223->setIsoCode("SY");
        $country223->setLabel("SYRIENNE, RÉPUBLIQUE ARABE");

        $country224 = new Country();
        $country224->setIsoCode("TJ");
        $country224->setLabel("TADJIKISTAN");

        $country225 = new Country();
        $country225->setIsoCode("TW");
        $country225->setLabel("TAÏWAN, PROVINCE DE CHINE");

        $country226 = new Country();
        $country226->setIsoCode("TZ");
        $country226->setLabel("TANZANIE, RÉPUBLIQUE-UNIE DE");

        $country227 = new Country();
        $country227->setIsoCode("TD");
        $country227->setLabel("TCHAD");

        $country228 = new Country();
        $country228->setIsoCode("CZ");
        $country228->setLabel("TCHÈQUE, RÉPUBLIQUE");

        $country229 = new Country();
        $country229->setIsoCode("TF");
        $country229->setLabel("TERRES AUSTRALES FRANÇAISES");

        $country230 = new Country();
        $country230->setIsoCode("TH");
        $country230->setLabel("THAÏLANDE");

        $country231 = new Country();
        $country231->setIsoCode("TL");
        $country231->setLabel("TIMOR-LESTE");

        $country232 = new Country();
        $country232->setIsoCode("TG");
        $country232->setLabel("TOGO");

        $country233 = new Country();
        $country233->setIsoCode("TK");
        $country233->setLabel("TOKELAU");

        $country234 = new Country();
        $country234->setIsoCode("TO");
        $country234->setLabel("TONGA");

        $country235 = new Country();
        $country235->setIsoCode("TT");
        $country235->setLabel("TRINITÉ-ET-TOBAGO");

        $country236 = new Country();
        $country236->setIsoCode("TN");
        $country236->setLabel("TUNISIE");

        $country237 = new Country();
        $country237->setIsoCode("TM");
        $country237->setLabel("TURKMÉNISTAN");

        $country238 = new Country();
        $country238->setIsoCode("TC");
        $country238->setLabel("TURKS-ET-CAÏCOS, ÎLES");

        $country239 = new Country();
        $country239->setIsoCode("TR");
        $country239->setLabel("TURQUIE");

        $country240 = new Country();
        $country240->setIsoCode("TV");
        $country240->setLabel("TUVALU");

        $country241 = new Country();
        $country241->setIsoCode("UA");
        $country241->setLabel("UKRAINE");

        $country242 = new Country();
        $country242->setIsoCode("UY");
        $country242->setLabel("URUGUAY");

        $country243 = new Country();
        $country243->setIsoCode("VU");
        $country243->setLabel("VANUATU");

        $country244 = new Country();
        $country244->setIsoCode("VE");
        $country244->setLabel("VENEZUELA, RÉPUBLIQUE BOLIVARIENNE DU");

        $country245 = new Country();
        $country245->setIsoCode("VN");
        $country245->setLabel("VIET NAM");

        $country246 = new Country();
        $country246->setIsoCode("WF");
        $country246->setLabel("WALLIS ET FUTUNA");

        $country247 = new Country();
        $country247->setIsoCode("YE");
        $country247->setLabel("YÉMEN");

        $country248 = new Country();
        $country248->setIsoCode("ZM");
        $country248->setLabel("ZAMBIE");

        $country249 = new Country();
        $country249->setIsoCode("ZW");
        $country249->setLabel("ZIMBABWE");

        $country250 = new Country();
        $country250->setIsoCode("");
        $country250->setLabel(" ");



        $manager->persist($country1);
        $manager->persist($country2);
        $manager->persist($country3);
        $manager->persist($country4);
        $manager->persist($country5);
        $manager->persist($country6);
        $manager->persist($country7);
        $manager->persist($country8);
        $manager->persist($country9);
        $manager->persist($country10);
        $manager->persist($country11);
        $manager->persist($country12);
        $manager->persist($country13);
        $manager->persist($country14);
        $manager->persist($country15);
        $manager->persist($country16);
        $manager->persist($country17);
        $manager->persist($country18);
        $manager->persist($country19);
        $manager->persist($country20);
        $manager->persist($country21);
        $manager->persist($country22);
        $manager->persist($country23);
        $manager->persist($country24);
        $manager->persist($country25);
        $manager->persist($country26);
        $manager->persist($country27);
        $manager->persist($country28);
        $manager->persist($country29);
        $manager->persist($country30);
        $manager->persist($country31);
        $manager->persist($country32);
        $manager->persist($country33);
        $manager->persist($country34);
        $manager->persist($country35);
        $manager->persist($country36);
        $manager->persist($country37);
        $manager->persist($country38);
        $manager->persist($country39);
        $manager->persist($country40);
        $manager->persist($country41);
        $manager->persist($country42);
        $manager->persist($country43);
        $manager->persist($country44);
        $manager->persist($country45);
        $manager->persist($country46);
        $manager->persist($country47);
        $manager->persist($country48);
        $manager->persist($country49);
        $manager->persist($country50);
        $manager->persist($country51);
        $manager->persist($country52);
        $manager->persist($country53);
        $manager->persist($country54);
        $manager->persist($country55);
        $manager->persist($country56);
        $manager->persist($country57);
        $manager->persist($country58);
        $manager->persist($country59);
        $manager->persist($country60);
        $manager->persist($country61);
        $manager->persist($country62);
        $manager->persist($country63);
        $manager->persist($country64);
        $manager->persist($country65);
        $manager->persist($country66);
        $manager->persist($country67);
        $manager->persist($country68);
        $manager->persist($country69);
        $manager->persist($country70);
        $manager->persist($country71);
        $manager->persist($country72);
        $manager->persist($country73);
        $manager->persist($country74);
        $manager->persist($country75);
        $manager->persist($country76);
        $manager->persist($country77);
        $manager->persist($country78);
        $manager->persist($country79);
        $manager->persist($country80);
        $manager->persist($country81);
        $manager->persist($country82);
        $manager->persist($country83);
        $manager->persist($country84);
        $manager->persist($country85);
        $manager->persist($country86);
        $manager->persist($country87);
        $manager->persist($country88);
        $manager->persist($country89);
        $manager->persist($country90);
        $manager->persist($country91);
        $manager->persist($country92);
        $manager->persist($country93);
        $manager->persist($country94);
        $manager->persist($country95);
        $manager->persist($country96);
        $manager->persist($country97);
        $manager->persist($country98);
        $manager->persist($country99);
        $manager->persist($country100);
        $manager->persist($country101);
        $manager->persist($country102);
        $manager->persist($country103);
        $manager->persist($country104);
        $manager->persist($country105);
        $manager->persist($country106);
        $manager->persist($country107);
        $manager->persist($country108);
        $manager->persist($country109);
        $manager->persist($country110);
        $manager->persist($country111);
        $manager->persist($country112);
        $manager->persist($country113);
        $manager->persist($country114);
        $manager->persist($country115);
        $manager->persist($country116);
        $manager->persist($country117);
        $manager->persist($country118);
        $manager->persist($country119);
        $manager->persist($country120);
        $manager->persist($country121);
        $manager->persist($country122);
        $manager->persist($country123);
        $manager->persist($country124);
        $manager->persist($country125);
        $manager->persist($country126);
        $manager->persist($country127);
        $manager->persist($country128);
        $manager->persist($country129);
        $manager->persist($country130);
        $manager->persist($country131);
        $manager->persist($country132);
        $manager->persist($country133);
        $manager->persist($country134);
        $manager->persist($country135);
        $manager->persist($country136);
        $manager->persist($country137);
        $manager->persist($country138);
        $manager->persist($country139);
        $manager->persist($country140);
        $manager->persist($country141);
        $manager->persist($country142);
        $manager->persist($country143);
        $manager->persist($country144);
        $manager->persist($country145);
        $manager->persist($country146);
        $manager->persist($country147);
        $manager->persist($country148);
        $manager->persist($country149);
        $manager->persist($country150);
        $manager->persist($country151);
        $manager->persist($country152);
        $manager->persist($country153);
        $manager->persist($country154);
        $manager->persist($country155);
        $manager->persist($country156);
        $manager->persist($country157);
        $manager->persist($country158);
        $manager->persist($country159);
        $manager->persist($country160);
        $manager->persist($country161);
        $manager->persist($country162);
        $manager->persist($country163);
        $manager->persist($country164);
        $manager->persist($country165);
        $manager->persist($country166);
        $manager->persist($country167);
        $manager->persist($country168);
        $manager->persist($country169);
        $manager->persist($country170);
        $manager->persist($country171);
        $manager->persist($country172);
        $manager->persist($country173);
        $manager->persist($country174);
        $manager->persist($country175);
        $manager->persist($country176);
        $manager->persist($country177);
        $manager->persist($country178);
        $manager->persist($country179);
        $manager->persist($country180);
        $manager->persist($country181);
        $manager->persist($country182);
        $manager->persist($country183);
        $manager->persist($country184);
        $manager->persist($country185);
        $manager->persist($country186);
        $manager->persist($country187);
        $manager->persist($country188);
        $manager->persist($country189);
        $manager->persist($country190);
        $manager->persist($country191);
        $manager->persist($country192);
        $manager->persist($country193);
        $manager->persist($country194);
        $manager->persist($country195);
        $manager->persist($country196);
        $manager->persist($country197);
        $manager->persist($country198);
        $manager->persist($country199);
        $manager->persist($country200);
        $manager->persist($country201);
        $manager->persist($country202);
        $manager->persist($country203);
        $manager->persist($country204);
        $manager->persist($country205);
        $manager->persist($country206);
        $manager->persist($country207);
        $manager->persist($country208);
        $manager->persist($country209);
        $manager->persist($country210);
        $manager->persist($country211);
        $manager->persist($country212);
        $manager->persist($country213);
        $manager->persist($country214);
        $manager->persist($country215);
        $manager->persist($country216);
        $manager->persist($country217);
        $manager->persist($country218);
        $manager->persist($country219);
        $manager->persist($country220);
        $manager->persist($country221);
        $manager->persist($country222);
        $manager->persist($country223);
        $manager->persist($country224);
        $manager->persist($country225);
        $manager->persist($country226);
        $manager->persist($country227);
        $manager->persist($country228);
        $manager->persist($country229);
        $manager->persist($country230);
        $manager->persist($country231);
        $manager->persist($country232);
        $manager->persist($country233);
        $manager->persist($country234);
        $manager->persist($country235);
        $manager->persist($country236);
        $manager->persist($country237);
        $manager->persist($country238);
        $manager->persist($country239);
        $manager->persist($country240);
        $manager->persist($country241);
        $manager->persist($country242);
        $manager->persist($country243);
        $manager->persist($country244);
        $manager->persist($country245);
        $manager->persist($country246);
        $manager->persist($country247);
        $manager->persist($country248);
        $manager->persist($country249);
        $manager->persist($country250);

        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }

}

?>
