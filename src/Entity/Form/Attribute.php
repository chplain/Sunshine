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

    /**
     * 字段名称
     * @var string
     */
    private $name;

    /**
     * 字段编码
     * @var string
     */
    private $code;

    /**
     * 字段类型
     * @var Options
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin\Options")
     * @ORM\JoinColumn(name="type", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $type;

    /**
     * 存储类型
     * @var string
     */
    private $storageType;

    /**
     * 排序位置
     * @var int
     */
    private $position;

    public function getId()
    {
        return $this->id;
    }
}
