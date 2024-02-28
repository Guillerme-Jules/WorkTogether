<?php

namespace App\DataFixtures;

use App\DTO\Buy;
use App\Entity\Accountant;
use App\Entity\Admin;
use App\Entity\Customer;
use App\Entity\CustomerTicket;
use App\Entity\Pack;
use App\Entity\Rack;
use App\Entity\Reservation;
use App\Entity\TypeReservation;
use App\Entity\TypeUnit;
use App\Entity\Unit;
use App\Entity\User;
use App\Repository\TypeReservationRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{


    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $connection = $manager->getConnection();
        $connection->executeStatement("DBCC CHECKIDENT ('pack', RESEED, 0);");
        $connection->executeStatement("DBCC CHECKIDENT ('user', RESEED, 0);");
        $connection->executeStatement("DBCC CHECKIDENT ('rack', RESEED, 0);");
        $connection->executeStatement("DBCC CHECKIDENT ('type_reservation', RESEED, 0);");
        $connection->executeStatement("DBCC CHECKIDENT ('type_unit', RESEED, 0);");
        $connection->executeStatement("DBCC CHECKIDENT ('unit', RESEED, 0);");
        $connection->executeStatement("DBCC CHECKIDENT ('reservation', RESEED, 0);");

        // Création des packs dans une boucle
        $pack = new Pack();
        $pack->setName('Standard');
        $pack->setPrice(100); // Prix aléatoire entre 1000 et 100000
        $pack->setNumberSlot(1); // Nombre de slot aléatoire entre 1 et 42
        $manager->persist($pack);
        $manager->flush();

        $pack = new Pack();
        $pack->setName('Start-up');
        $pack->setPrice(900); // Prix aléatoire entre 1000 et 100000
        $pack->setNumberSlot(10); // Nombre de slot aléatoire entre 1 et 42
        $manager->persist($pack);
        $manager->flush();

        $pack = new Pack();
        $pack->setName('PME');
        $pack->setPrice(1680); // Prix aléatoire entre 1000 et 100000
        $pack->setNumberSlot(21); // Nombre de slot aléatoire entre 1 et 42
        $manager->persist($pack);
        $manager->flush();

        $pack = new Pack();
        $pack->setName('Entreprise');
        $pack->setPrice(2940); // Prix aléatoire entre 1000 et 100000
        $pack->setNumberSlot(42); // Nombre de slot aléatoire entre 1 et 42
        $manager->persist($pack);
        $manager->flush();


        // Création d'utilisateurs dans une boucle
        for ($i = 1; $i <= 10; $i++) {
            $customer = new Customer();
            $customer->setFirstName('UserFirstName' . $i);
            $customer->setLastName('UserLastName' . $i);
            $customer->setEmail('user' . $i . '@example.com');
            // Encodage simple du mot de passe
            $password = $this->hasher->hashPassword($customer, 'password');
            $customer->setPassword($password);
            // Génération de dates de naissance aléatoires pour les utilisateurs
            $birthday = new \DateTime();
            $birthday->setTimestamp(mt_rand(strtotime('1980-01-01'), strtotime('2000-12-31')));
            $customer->setRoles(["ROLE_CLIENT"]);
            $customer->setBirthday($birthday);

            $manager->persist($customer);
        }
        $manager->flush();
        $admin = new Admin();
        $admin->setEmail("admin@admin.com");
        $password = $this->hasher->hashPassword($admin, 'admin-Password');
        $admin->setPassword($password);
        $admin->setRoles(["ROLE_ADMIN"]);
        $manager->persist($admin);
        $manager->flush();

        $accountant = new Accountant();
        $accountant->setEmail("compt@compt.com");
        $password = $this->hasher->hashPassword($accountant, 'compt-Password');
        $accountant->setPassword($password);
        $accountant->setRoles(["ROLE_COMPT"]);
        $manager->persist($accountant);
        $manager->flush();
        // Création des tickets
        $customers = $manager->getRepository(Customer::class)->findAll();
        for ($i = 1; $i <= 10; $i++) {
            $ticket = new CustomerTicket();
            $ticket->setDone(false);
            $ticket->setName("ticket".$i);
            $ticket->setDescription("J'ai rencontré un problème ...");
            $ticket->setCustomer($customers[random_int(0, count($customers) - 1)]);
            $manager->persist($ticket);
        }
        $manager->flush();
        // Création des baies dans une boucle
        for ($i = 1; $i <= 10; $i++) {

            $rack = new Rack();
            $rack->setNumberSlot(42);

            $manager->persist($rack);
        }
        $manager->flush();
        // Création des types d'unités dans une boucle

        $typeUnit = new TypeUnit();
        $typeUnit->setName('Stockage');
        $manager->persist($typeUnit);

        $manager->flush();

        $typeUnit = new TypeUnit();
        $typeUnit->setName('Calcul');
        $manager->persist($typeUnit);

        $manager->flush();

        $typeUnit = new TypeUnit();
        $typeUnit->setName('CPU');
        $manager->persist($typeUnit);

        $manager->flush();

        $racks = $manager->getRepository(Rack::class)->findAll();
        $typeUnit = $manager->getRepository(TypeUnit::class)->findAll();

        foreach ($racks as $rack) {
            for ($i = 1; $i <= $rack->getNumberSlot(); $i++) {
                $unit = new Unit();
                $unit->setLocationSlot($i);
                $unit->setTypeUnit(null);
                $unit->setRack($rack);
                $unit->setReservation(null);
                $manager->persist($unit);
            }
            $manager->flush();
        }
        // Création des types de réservation dans une boucle

        $typeReservation = new TypeReservation();
        $typeReservation->setName('mensuel');
        $typeReservation->setPercentage(0);
        $typeReservation->setMonth(1);
        $manager->persist($typeReservation);

        $typeReservation = new TypeReservation();
        $typeReservation->setName('annuel');
        $typeReservation->setPercentage(20);
        $typeReservation->setMonth(12);
        $manager->persist($typeReservation);

        $manager->flush();
        // récupérations de packs, type de réservations et des customers
        $customers = $manager->getRepository(Customer::class)->findAll();
        $typeReservation = $manager->getRepository(TypeReservation::class)->findAll();
        $pack = $manager->getRepository(Pack::class)->findAll();
        // Création des réservations dans une boucle
        for ($i = 1; $i <= 10; $i++) {
            $reservation = new Reservation();
            $buy = New Buy();
            $buy->setTypeReservation($typeReservation[random_int(0, count($typeReservation) - 1)]);
            $reservation->setElement($pack[random_int(0, count($pack) - 1)], $customers[random_int(0, count($customers) - 1)], $buy);
            $manager->persist($reservation);
            $manager->flush();
            $units = $manager->getRepository(Unit::class)->findBy(array('reservation' => null));
            for($j = 0 ; $j < $reservation->getPack()->getNumberSlot(); $j++){
                $units[$j]->setReservation($reservation);
                $manager->flush();
            }
        }
    }
}



