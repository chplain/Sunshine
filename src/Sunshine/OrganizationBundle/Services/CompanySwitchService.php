<?php

namespace Sunshine\OrganizationBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;

class CompanySwitchService
{
    protected $em;

    public function __construct(EntityManager $manager)
    {
        $this->em = $manager;
    }
}