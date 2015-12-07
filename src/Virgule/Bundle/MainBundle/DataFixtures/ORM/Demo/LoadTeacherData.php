<?php

namespace Virgule\Bundle\MainBundle\DataFixtures\ORM\Demo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Teacher;

/**
 * Description of LoadTeacherData
 *
 * @author Guillaume Lucazeau
 */
class LoadTeacherData extends AbstractFixture implements OrderedFixtureInterface {

  public function load(ObjectManager $manager) {
    $prof1 = new Teacher();
    $prof1->setUsername("prof1");
    $prof1->setPlainPassword("password");
    $prof1->setFirstName("Henry");
    $prof1->setLastName("Jones");
    $prof1->setCellphoneNumber("0605040302");
    $prof1->setPhoneNumber("0102030405");
    $prof1->setEmail("henry.jones@example.com");
    $prof1->setRegistrationDate(new \DateTime('now'));
    $prof1->setRole($this->getReference('user-role'));
    $prof1->addOrganizationBranch($this->getReference('deleg-3-10'));
    $prof1->setEnabled(true);
    $prof1->setLocked(false);
    $prof1->setExpired(false);
    $prof1->setCredentialsExpired(false);

    $prof2 = new Teacher();
    $prof2->setUsername("prof2");
    $prof2->setPlainPassword("password");
    $prof2->setFirstName("John");
    $prof2->setLastName("Keating");
    $prof2->setCellphoneNumber("0605040302");
    $prof2->setEmail("john.keating@example.com");
    $prof2->setRegistrationDate(new \DateTime('now'));
    $prof2->setRole($this->getReference('secretary-role'));
    $prof2->addOrganizationBranch($this->getReference('deleg-3-10'));
    $prof2->setEnabled(true);
    $prof2->setLocked(false);
    $prof2->setExpired(false);
    $prof2->setCredentialsExpired(false);

    $prof3 = new Teacher();
    $prof3->setUsername("prof3");
    $prof3->setPlainPassword("password");
    $prof3->setFirstName("Walter");
    $prof3->setLastName("Lewin");
    $prof3->setEmail("walter.lewin@example.com");
    $prof3->setRegistrationDate(new \DateTime('now'));
    $prof3->setRole($this->getReference('user-role'));
    $prof3->addOrganizationBranch($this->getReference('deleg-3-10'));
    $prof3->setEnabled(true);
    $prof3->setLocked(false);
    $prof3->setExpired(false);
    $prof3->setCredentialsExpired(false);

    $prof4 = new Teacher();
    $prof4->setUsername("prof4");
    $prof4->setPlainPassword("password");
    $prof4->setFirstName("Philippe");
    $prof4->setLastName("Marrast");
    $prof4->setEmail("philippe.marrast@example.com");
    $prof4->setRegistrationDate(new \DateTime('now'));
    $prof4->setRole($this->getReference('user-role'));
    $prof4->addOrganizationBranch($this->getReference('deleg-3-10'));
    $prof4->setEnabled(true);
    $prof4->setLocked(false);
    $prof4->setExpired(false);
    $prof4->setCredentialsExpired(false);

    $guest = new Teacher();
    $guest->setUsername("guest");
    $guest->setPlainPassword("password");
    $guest->setFirstName("Ludovic");
    $guest->setLastName("Tessier");
    $guest->setEmail("ludovic.tessier@example.com");
    $guest->setRegistrationDate(new \DateTime('now'));
    $guest->setRole($this->getReference('guest-role'));
    $guest->addOrganizationBranch($this->getReference('deleg-3-10'));
    $guest->setEnabled(true);
    $guest->setLocked(false);
    $guest->setExpired(false);
    $guest->setCredentialsExpired(false);

    $secretary = new Teacher();
    $secretary->setUsername("secretary");
    $secretary->setPlainPassword("password");
    $secretary->setFirstName("Safia");
    $secretary->setLastName("Slimane");
    $secretary->setEmail("safia.slimane@example.com");
    $secretary->setRegistrationDate(new \DateTime('now'));
    $secretary->setRole($this->getReference('secretary-role'));
    $secretary->addOrganizationBranch($this->getReference('deleg-3-10'));
    $secretary->setEnabled(true);
    $secretary->setLocked(false);
    $secretary->setExpired(false);
    $secretary->setCredentialsExpired(false);

    $inactiveUser = new Teacher();
    $inactiveUser->setIsActive(false);
    $inactiveUser->setUsername("glucazeau");
    $inactiveUser->setPlainPassword("password");
    $inactiveUser->setFirstName("Guillaume");
    $inactiveUser->setLastName("Lucazeau");
    $inactiveUser->setEmail("glucazeau@example.com");
    $inactiveUser->setRegistrationDate(new \DateTime('now'));
    $inactiveUser->setRole($this->getReference('admin-role'));
    $inactiveUser->addOrganizationBranch($this->getReference('deleg-3-10'));
    $inactiveUser->setEnabled(false);
    $inactiveUser->setLocked(false);
    $inactiveUser->setExpired(true);
    $inactiveUser->setCredentialsExpired(true);

    $manager->persist($prof1);
    $manager->persist($prof2);
    $manager->persist($prof3);
    $manager->persist($prof4);
    $manager->persist($guest);
    $manager->persist($secretary);
    $manager->persist($inactiveUser);

    $this->addReference('prof1', $prof1);
    $this->addReference('prof2', $prof2);
    $this->addReference('prof3', $prof3);
    $this->addReference('prof4', $prof4);

    for ($i = 5; $i <= 50; $i++) {
      $p = new Teacher();
      $p->setUsername("prof" . $i);
      $p->setPlainPassword("password");
      $p->setFirstName("Jean");
      $p->setLastName("Dupont " . $i);
      $p->setEmail("jean.dupont." . $i . "@example.com");
      $p->setRegistrationDate(new \DateTime('now'));
      $p->setRole($this->getReference('guest-role'));
      $p->addOrganizationBranch($this->getReference('deleg-5'));
      $p->setEnabled(true);
      $p->setLocked(false);
      $p->setExpired(false);
      $p->setCredentialsExpired(false);

      $manager->persist($p);

      $this->addReference('prof' . $i, $p);
    }

    $manager->flush();
  }

  public function getOrder() {
    return 13;
  }

}

?>
