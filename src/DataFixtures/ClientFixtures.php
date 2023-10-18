<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Client;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
class ClientFixtures extends Fixture
{
    private $faker;
    
    public function __construct(){
        $this->faker=Factory::create("fr_FR");
 }

    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<30;$i++){
            $clients = new Client();
            $clients->setNom($this->faker->lastName())
            ->setPrenom($this->faker->firstName())
            ->setAdresseRue($this->faker->streetAddress())
            ->setCodepostal($this->faker->postcode())
            ->setVille($this->faker->city())
            ->setTelFixe($this->faker->phoneNumber())
            ->setTelPortable($this->faker->phoneNumber())
            ->setCourriel($this->faker->paragraph());
            $this->addReference('Client'.$i, $clients);
            $manager->persist($clients);
        }
        $manager->flush();
    }
}