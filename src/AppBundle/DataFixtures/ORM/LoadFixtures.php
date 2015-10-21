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
    }

    private function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('user');
        $user->setEmail('user@example.com');
		$user->setRoles(array('ROLE_USER'));
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
		//$editor->setSalt(md5(uniqid()));
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($editor)
        ;
        $editor->setPassword($encoder->encodePassword('administrator', $editor->getSalt()));
        $manager->persist($editor);

        $manager->flush();
    }

   
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

}
