<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setEmail('admin@mail.ru');
        $admin->setSurname('Лобов');
        $admin->setName('Максим');
        $admin->setMidname('Юрьевич');
        $admin->setPhone('89006009477');
        $admin->setPassword($this->passwordHasher->hashPassword($admin,'admin123'));
        $admin->setRoles(['ROLE_ADMIN']);

        $client = new User();
        $client->setEmail('client@mail.ru');
        $client->setSurname('Крутских');
        $client->setName('Анастасия');
        $client->setMidname('Юрьевна');
        $client->setPhone('89191690869');
        $client->setPassword($this->passwordHasher->hashPassword($client,'client123'));

        $seller = new User();
        $seller->setEmail('seller@mail.ru');
        $seller->setSurname('Сухоруков');
        $seller->setName('Кирилл');
        $seller->setMidname('Олегович');
        $seller->setPhone('89191629051');
        $seller->setPassword($this->passwordHasher->hashPassword($seller,'seller123'));
        $seller->setRoles(['ROLE_SELLER']);

        $hk = new User();
        $hk->setEmail('hktest@mail.ru');
        $hk->setSurname('Сухоруких');
        $hk->setName('Артём');
        $hk->setMidname('Олегович');
        $hk->setPhone('89001001010');
        $hk->setPassword($this->passwordHasher->hashPassword($seller,'hktest123'));
        $hk->setRoles(['ROLE_HK']);

        $manager->persist($admin);
        $manager->persist($client);
        $manager->persist($seller);
        $manager->persist($hk);

        $manager->flush();
    }
}
