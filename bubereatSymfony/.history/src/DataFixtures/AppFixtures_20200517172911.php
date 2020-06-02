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
            $plat->setName($faker->foodName())
                ->setPrice($faker->numberBetween(2, 30))
                ->setDescription($faker->text())
                ->setPicture("https://fac.img.pmdstatic.net/fit/http.3A.2F.2Fprd2-bone-image.2Es3-website-eu-west-1.2Eamazonaws.2Ecom.2Ffac.2F2018.2F07.2F30.2Faa8e3333-1c0d-4317-8b3d-9d474b63ad70.2Ejpeg/750x562/quality/80/crop-from/center/cr/wqkgU3R1ZGlvIC8gU3VjcsOpIFNhbMOpIC8gRmVtbWUgQWN0dWVsbGU%3D/pizza-blanche-chevre-miel-et-creme-fraiche.jpeg");

            $manager->persist($plat);
            $Plats[] = $plat;
        }

        for ($i = 0; $i < 60; $i++) {
            $formule = new Formules();
            $formule->setName($faker->word())
                ->setReduction($faker->numberBetween(0, 60))
                ->setPicture("https://cac.img.pmdstatic.net/fit/http.3A.2F.2Fprd2-bone-image.2Es3-website-eu-west-1.2Eamazonaws.2Ecom.2Fcac.2F2018.2F09.2F25.2F03ab5e89-bad7-4a44-b952-b30c68934215.2Ejpeg/410x230/quality/80/crop-from/center/burger-maison.jpeg")
                ->setDescription($faker->text())
                ->setPrice($faker->numberBetween(10, 40));

            $manager->persist($formule);
            $Formules[] = $formule;
        }

        for ($i = 0; $i < 40; $i++) {
            $restaurant = new Restaurants();
            $restaurant->setName("le restaurant de ". $faker->name())
                ->setType($faker->word())
                ->setAdresse($faker->streetAddress())
                ->setPicture("https://media-cdn.tripadvisor.com/media/photo-s/1a/08/d9/91/salle-du-restaurant.jpg")
                ->setDescription($faker->text)
                ->setStars($faker->numberBetween(1, 5))
                ->setTendance($faker->boolean)
                ->addPlat($Plats[$faker->numberBetween(0, count($Formules) - 1)]);

            $manager->persist($restaurant);
            $Restaurants[] = $restaurant;
        }

        for ($i = 0; $i < 300; $i++) {
            $commande = new Commandes();
            $commande->setState($faker->numberBetween(State::IN_PROGRESS, State::DELIVERED))
                ->setAddress($faker->streetAddress());

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
                ->setName($faker->lastName())
                ->setAvatar($faker->imageUrl($width = 640, $height = 480))
                ->setSurname($faker->firstName())
                ->setBalance($faker->numberBetween($min = 1000, $max = 9000));

            $manager->persist($user);
        }

        $user = new User();
        $user->setEmail("gg@gmail.com")
            ->setPassword($this->encoder->encodePassword($user, "ihfbdjsqFD454"))
            ->setRoles(['ROLE_USER', 'ROLE_RESTORER'])
            ->setSurname("gg")
            ->addRestaurant($Restaurants[$faker->numberBetween(0, count($Restaurants) - 1)])
            ->setAvatar($faker->imageUrl($width = 640, $height = 480));

        $manager->persist($user);

        $manager->flush();
    }
}
