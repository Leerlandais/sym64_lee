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

        

        $manager->flush();
    }
}
