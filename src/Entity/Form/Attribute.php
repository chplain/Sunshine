<?php

namespace App\Entity\Form;

use App\Entity\Admin\Options;
use App\Entity\GedmoTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * 表单动态属性
 *
 * @ORM\Table(name="sunshine_form_attribute", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="App\Repository\Form\AttributeRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deleteAt", timeAware=false)
 * @Gedmo\Loggable
 */
class Attribute
{
    use GedmoTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    private $code;

    private $type;

    private $storageType;

    private $position;

    public function getId()
    {
        return $this->id;
    }
}
