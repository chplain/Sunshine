<?php

namespace Sunshine\OrganizationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusinessUnit
 *
 * @ORM\Table(name="business_unit")
 * @ORM\Entity(repositoryClass="Sunshine\OrganizationBundle\Repository\BusinessUnitRepository")
 */
class BusinessUnit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var \Datetime $updateAt
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

