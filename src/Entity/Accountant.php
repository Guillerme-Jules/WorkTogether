<?php

namespace App\Entity;

use App\Repository\AccountantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountantRepository::class)]
class Accountant extends User
{

}
