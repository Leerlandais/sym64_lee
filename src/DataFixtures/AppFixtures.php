<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// load my entities
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Section;

// load other dependencies
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory AS Faker;
use Cocur\Slugify\Slugify;
use DateTime;

class AppFixtures extends Fixture
{

    private $faker;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher){
        $this->hasher = $userPasswordHasher;
        $this->faker = Faker::create('en_IE');
    }
    public function load(ObjectManager $manager): void
    {
        $slugify = new Slugify();
        // declaring these here rather than inside the loops as they will be needed for the relations
        $articles = [];
        $sections = [];

        // Start by creating the different user types
        // create me...
        $super = new User();
        $super->setUsername('leerlandais');
        $super->setRoles(['ROLE_SUPER', 'ROLE_ADMIN', 'ROLE_REDAC', 'ROLE_USER']);
        $super->setEmail('lee@leerlandais.com');
        $super->setFullName("Lee Brennan");
        $super->setActivate(true);
        $super->setUniqid(uniqid('user_', true));
        $pwdHash = $this->hasher->hashPassword($super, '270675');
        $super->setPassword($pwdHash);
        $this->admins[1] = $super;
        // ... and save me
        $manager->persist($super);

        // create the admin
        $admin = new User();

        $admin->setUsername('admin');
        $admin->setRoles(['ROLE_ADMIN', 'ROLE_REDAC', 'ROLE_USER']);
        $admin->setEmail($this->faker->email);
        $admin->setFullName("Admin");
        $admin->setActivate(true);
        $admin->setUniqid(uniqid('user_', true));
        $pwdHash = $this->hasher->hashPassword($admin, 'admin');
        $admin->setPassword($pwdHash);

        $this->admins[2] = $admin;

        $manager->persist($admin);

        $manager->flush();
    }
}
