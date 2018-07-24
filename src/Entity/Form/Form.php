<?php

namespace App\Entity\Form;

use App\Entity\Admin\Options;
use App\Entity\GedmoTrait;
use App\Entity\Organization\User;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Form
 *
 * @ORM\Table(name="sunshine_form_form", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="App\Repository\Form\FormRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 */
class Form
{
    use GedmoTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * form name 表单名称
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * 所属类型 (例如 财务审批、人事审批、行政审批、供应链审批等)
     * @var Options
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin\Options")
     * @ORM\JoinColumn(name="type", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $type;

    /**
     * 所属人
     * @var Options
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization\User")
     * @ORM\JoinColumn(name="owner", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $owner;

    /**
     * 表单状态(已发布、未发布等)
     * @var Options
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin\Options")
     * @ORM\JoinColumn(name="state", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $state;

    /**
     * @var Attribute[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Form\Attribute", mappedBy="form", orphanRemoval=true, cascade={"persist"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $attributes;

    /**
     * 构造函数
     * 初始化属性为Collection
     */
    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    //    ,----..                                                         ___
    //    /   /   \                                                      ,--.'|_                  ,---,
    //    |   :     :                ,---,             __  ,-.            |  | :,'               ,---.'|
    //    .   |  ;. /            ,-+-. /  |          ,' ,'/ /|            :  : ' :               |   | :
    //    .   ; /--`     ,---.  ,--.'|'   |   ,---.  '  | |' | ,--.--.  .;__,'  /     ,---.      |   | |
    //    ;   | ;  __   /     \|   |  ,"' |  /     \ |  |   ,'/       \ |  |   |     /     \   ,--.__| |
    //    |   : |.' .' /    /  |   | /  | | /    /  |'  :  / .--.  .-. |:__,'| :    /    /  | /   ,'   |
    //    .   | '_.' :.    ' / |   | |  | |.    ' / ||  | '   \__\/: . .  '  : |__ .    ' / |.   '  /  |
    //    '   ; : \  |'   ;   /|   | |  |/ '   ;   /|;  : |   ," .--.; |  |  | '.'|'   ;   /|'   ; |:  |
    //    '   | '/  .''   |  / |   | |--'  '   |  / ||  , ;  /  /  ,.  |  ;  :    ;'   |  / ||   | '/  '
    //    |   :    /  |   :    |   |/      |   :    | ---'  ;  :   .'   \ |  ,   / |   :    ||   :    :|
    //     \   \ .'    \   \  /'---'        \   \  /        |  ,     .-./  ---`-'   \   \  /  \   \  /
    //      `---`       `----'               `----'          `--`---'                `----'    `----'


    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?Options
    {
        return $this->type;
    }

    public function setType(?Options $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getState(): ?Options
    {
        return $this->state;
    }

    public function setState(?Options $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection|Attribute[]
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    public function addAttribute(Attribute $attribute): self
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes[] = $attribute;
            $attribute->setForm($this);
        }

        return $this;
    }

    public function removeAttribute(Attribute $attribute): self
    {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
            // set the owning side to null (unless already changed)
            if ($attribute->getForm() === $this) {
                $attribute->setForm(null);
            }
        }

        return $this;
    }
}
