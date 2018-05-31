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
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * 字段编码
     * @var string
     * @ORM\Column(name="code", type="string", length=50)
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
     *
     * @ORM\Column(name="storage_type", type="string", length=50)
     */
    private $storageType;

    /**
     * 排序位置
     * @var int
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var Form
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Form\Form", inversedBy="attributes", cascade={"persist"})
     * @ORM\JoinColumn(name="form", referencedColumnName="id", onDelete="SET NULL")
     */
    private $form;

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

    public function getStorageType(): ?string
    {
        return $this->storageType;
    }

    public function setStorageType(string $storageType): self
    {
        $this->storageType = $storageType;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
    }

    /**
     * @param Form $form
     * @return Attribute
     */
    public function setForm(Form $form): self
    {
        $this->form = $form;

        return $this;
    }
}
