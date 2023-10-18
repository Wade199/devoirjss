<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Bijou;
use App\Entity\Categorie;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BijouFixtures extends Fixture
{
    private $faker;

    public function __construct(){
        $this->faker=Factory::create("fr_FR");
    }

    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<30;$i++){
            $bijou = new Bijou();
            $bijou->setdescription($this->faker->catchPhrase());
            $bijou->setPrixVente($this->faker->sentence());
            $bijou->setPrixLocation($this->faker->catchPhrase());
            $this->addReference('Bijou'.$i, $bijou);
            $manager->persist($bijou);
        }

        $manager->flush();
    } 

    public function getDependencies()
    {
        return [
            CategorieFixtures::class,
        ];
}
}
