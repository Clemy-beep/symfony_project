<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Article;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        $contents = ['Lorem ipsum dolor sit am id elit, consectetur adipiscing elit euismod, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Content Article 2', '"After almost 12 years, first as a summer intern, then in the Death Star and now in London, I believe I have worked here long enough to understand the trajectory of its culture, its people and its massive, genocidal space machines," the mock article said. '];

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $hashpwd = $this->encoder->hashPassword($user, $faker->password);
            $user->setEmail($faker->email)->setUsername($faker->userName)->setPassword($hashpwd);
            $manager->persist($user);
            $article = new Article();
            $article->setTitle('Title' . $i)->setContent($contents[0])->setAuthor($user);
            $manager->persist($article);
        }
        // $user = new User();
        // $user->setEmail('foo@bar.com')->setUsername('foobar')->setPassword($hashpwd);
        // $manager->persist($user);
        // for ($i = 0; $i <= 2; $i++) {
        //     $article = new Article();
        //     $article->setTitle('Title' . $i)->setContent($contents[$i])->setAuthor($user);
        //     $manager->persist($article);
        // }
        $manager->flush();
    }
}
