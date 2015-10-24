<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Section;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines the sample data to load in the database when executing this command:
 *   $ php app/console doctrine:fixtures:load
 *
 * See http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class LoadFixtures implements FixtureInterface, ContainerAwareInterface
{
    /** @var ContainerInterface */
    private $container;

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadSections($manager);
    }

    private function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('user');
        $user->setEmail('user@example.com');
		$user->setRoles(array('ROLE_USER'));
        $user->setEnabled(true);
		//$user->setSalt(md5(uniqid()));

        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($user)
        ;
        $user->setPassword($encoder->encodePassword('onlyshowdata', $user->getSalt()));
        $manager->persist($user);

        $editor = new User();
        $editor->setUsername('editor');
        $editor->setEmail('editor@example.com');
        $editor->setRoles(array('ROLE_USER','ROLE_ADMIN'));
        $editor->setEnabled(true);
		//$editor->setSalt(md5(uniqid()));
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($editor)
        ;
        $editor->setPassword($encoder->encodePassword('administrator', $editor->getSalt()));
        $manager->persist($editor);

        $manager->flush();
    }

    private function loadSections(ObjectManager $manager)
    {
        $section1 = new Section();
        $section1->setName('Одежда для мальчиков');
        $section1->setParentId(0);
        $section1->setActive(1);
        $section1->setCreatedAt(new \DateTime());
        $section1->setModifiedAt(new \DateTime());
        $section1->setAlias('odezhda-dlya-malchikov');
        $section1->setPath('/');
        $manager->persist($section1);

        $section2 = new Section();
        $section2->setName('Одежда для девочек');
        $section2->setParentId(0);
        $section2->setActive(1);
        $section2->setCreatedAt(new \DateTime());
        $section2->setModifiedAt(new \DateTime());
        $section2->setAlias('odezhda-dlya-devochek');
        $section2->setPath('/');
        $manager->persist($section2);

        $section3 = new Section();
        $section3->setName('Обувь для мальчиков');
        $section3->setParentId(0);
        $section3->setActive(1);
        $section3->setCreatedAt(new \DateTime());
        $section3->setModifiedAt(new \DateTime());
        $section3->setAlias('obuv-dlya-malchikov');
        $section3->setPath('/');
        $manager->persist($section3);

        $section4 = new Section();
        $section4->setName('Обувь для девочек');
        $section4->setParentId(0);
        $section4->setActive(1);
        $section4->setCreatedAt(new \DateTime());
        $section4->setModifiedAt(new \DateTime());
        $section4->setAlias('obuv-dlya-devochek');
        $section4->setPath('/');
        $manager->persist($section4);

        $manager->flush();
    }

   
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

}
