<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Event;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // 1. Création de l'Admin
        $admin = new User();
        $admin->setEmail('admin@event.com'); // CORRECTION ICI (setEmail)
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->hasher->hashPassword($admin, 'password'));
        $manager->persist($admin);

        // 2. Création d'un User normal
        $user = new User();
        $user->setEmail('user@event.com'); // CORRECTION ICI (setEmail)
        $user->setPassword($this->hasher->hashPassword($user, 'password'));
        $manager->persist($user);

        // 3. Création des Catégories
        $categories = [];
        $categoryNames = ['Concert', 'Conférence', 'Sport', 'Atelier'];
        
        foreach ($categoryNames as $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
            $categories[] = $category;
        }

        // 4. Création des Événements
        for ($i = 1; $i <= 10; $i++) {
            $event = new Event();
            $event->setTitle('Événement n°' . $i);
            $event->setDescription('Ceci est une description détaillée pour l\'événement numéro ' . $i . '. Venez nombreux !');
            $event->setDate(new \DateTime('+' . rand(1, 30) . ' days'));
            
            // Relations
            $event->setCategory($categories[array_rand($categories)]);
            $event->setAuthor($admin);
            
            $manager->persist($event);
        }

        $manager->flush();
    }
}