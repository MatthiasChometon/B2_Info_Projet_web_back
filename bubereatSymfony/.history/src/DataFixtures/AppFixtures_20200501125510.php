<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use DateTime;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;
use App\Entity\Commandes;
use App\Entity\Formules;
use App\Commandes\State;
use App\Entity\Identification;
use App\Entity\Plats;
use App\Entity\Restaurants;
use App\RolesUsers\Roles;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

        $Commandes = [];
        $Formules = [];
        $Plats = [];
        $Restaurants = [];

        for ($i = 0; $i < 200; $i++) {
            $plat = new Plats();
            $plat->setNom($faker->foodName())
                ->setPrix($faker->numberBetween(0, 30));

            $manager->persist($plat);
            $Plats[] = $plat;
        }

        for ($i = 0; $i < 60; $i++) {
            $formule = new Formules();
            $formule->setNom($faker->word())
                ->setReduction($faker->numberBetween(0, 60));

            $manager->persist($formule);
            $Formules[] = $formule;
        }

        for ($i = 0; $i < 40; $i++) {
            $restaurant = new Restaurants();
            $restaurant->setNom($faker->word())
                ->setType($faker->word())
                ->setAdresse($faker->streetAddress());

            $manager->persist($restaurant);
            $Restaurants[] = $restaurant;
        }

        for ($i = 0; $i < 300; $i++) {
            $commande = new Commandes();
            $commande->setState($faker->numberBetween(State::IN_PROGRESS, State::DELIVERED));

            $manager->persist($commande);
            $Commandes[] = $commande;
        }

        #create links between the entity

        for ($i = 0; $i < 200; $i++) {
            $plat->addFormule($Formules[$faker->numberBetween(0, count($Formules) - 1)]);

            $manager->persist($plat);
        }

        for ($i = 0; $i < 60; $i++) {
            $formule->addPlat($Plats[$faker->numberBetween(0, count($Plats) - 1)])
                ->addRestaurant($Restaurants[$faker->numberBetween(0, count($Restaurants) - 1)])
                ->addCommande($Commandes[$faker->numberBetween(0, count($Commandes) - 1)]);

            $manager->persist($formule);
        }

        for ($i = 0; $i < 40; $i++) {
            $restaurant->addCommande($Commandes[$faker->numberBetween(0, count($Commandes) - 1)])
                ->addFormule($Formules[$faker->numberBetween(0, count($Formules) - 1)]);

            $manager->persist($restaurant);
        }

        for ($i = 0; $i < 300; $i++) {
            $commande->addFormule($Formules[$faker->numberBetween(0, count($Formules) - 1)])
                ->addRestaurant($Restaurants[$faker->numberBetween(0, count($Restaurants) - 1)]);

            $manager->persist($commande);
        }

        for ($i = 0; $i < 60; $i++) {
            $user = new User();
            $user->setEmail($faker->email())
                ->setPassword($this->encoder->encodePassword($user, $faker->password()))
                ->setRoles(['ROLE_USER', Roles::ROLES[$faker->numberBetween(Roles::ROLE_USER, Roles::ROLE_DELIVERER)]])
                ->setSurname($faker->name());

            $manager->persist($user);
        }

        $user = new User();
        $user->setEmail("gg@gmail.com")
            ->setPassword($this->encoder->encodePassword($user, "ihfbdjsqFD454"))
            ->setRoles(['ROLE_USER','ROLE_RESTORER'])
            ->setSurname("gg")
            ->addRestaurant($Restaurants[$faker->numberBetween(0, count($Restaurants) - 1)])
            ->setAvatar($faker->);

        $manager->persist($user);
        
        $identification = new Identification();
        $identification->setUserId(1)
            ->setToken("dfsdfsdfsdfsdfds");

        $manager->persist($identification);

        $manager->flush();
    }
}