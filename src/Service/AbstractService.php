<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class AbstractService
{

    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

}
