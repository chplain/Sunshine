<?php

namespace App\Entity\Organization;

use App\Entity\GedmoTrait;
use App\Entity\Admin\Choice;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Organization\User;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Entity\Organization\BusinessUnit;

/**
 * WorkGroup
 *
 * @ORM\Table(name="sunshine_organization_work_group", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="App\Repository\Organization\WorkGroupRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 */
class WorkGroup
{
    use GedmoTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * 组名称
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * 排序号
     * @var int
     *
     * @ORM\Column(name="order_num", type="integer", options={"unsigned"=true})
     */
    private $orderNum;

    /**
     * 所属部门
     * @var BusinessUnit
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization\BusinessUnit", inversedBy="groups")
     * @ORM\JoinColumn(name="group_business_unit_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $businessUnit;

    /**
     * 组主管
     * @var User
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Organization\User")
     * @ORM\JoinColumn(name="group_manager_id", referencedColumnName="id", nullable=true)
     */
    private $groupManager;

    /**
     * 是否启动
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * 组类型
     * @var Choice
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Admin\Choice")
     * @ORM\JoinColumn(name="group_type_choice_id", referencedColumnName="id", nullable=true)
     */
    private $type;

    /**
     * 权限属性
     * @var Choice
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Admin\Choice")
     * @ORM\JoinColumn(name="group_authority_choice_id", referencedColumnName="id", nullable=true)
     */
    private $authority;

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


    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set orderNum
     *
     * @param integer $orderNum
     */
    public function setOrderNum($orderNum): void
    {
        $this->orderNum = $orderNum;
    }

    /**
     * Get orderNum
     *
     * @return integer
     */
    public function getOrderNum(): int
    {
        return $this->orderNum;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     */
    public function setEnabled($enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Set businessUnit
     *
     * @param \App\Entity\Organization\BusinessUnit $businessUnit
     */
    public function setBusinessUnit(BusinessUnit $businessUnit = null): void
    {
        $this->businessUnit = $businessUnit;
    }

    /**
     * Get businessUnit
     *
     * @return \App\Entity\Organization\BusinessUnit
     */
    public function getBusinessUnit(): BusinessUnit
    {
        return $this->businessUnit;
    }

    /**
     * Set groupManager
     *
     * @param \App\Entity\Organization\User $groupManager
     */
    public function setGroupManager(User $groupManager = null): void
    {
        $this->groupManager = $groupManager;
    }

    /**
     * Get groupManager
     *
     * @return \App\Entity\Organization\User
     */
    public function getGroupManager(): User
    {
        return $this->groupManager;
    }

    /**
     * Set type
     *
     * @param \App\Entity\Admin\Choice $type
     */
    public function setType(Choice $type = null): void
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return \App\Entity\Admin\Choice
     */
    public function getType(): Choice
    {
        return $this->type;
    }

    /**
     * Set authority
     *
     * @param \App\Entity\Admin\Choice $authority
     */
    public function setAuthority(\App\Entity\Admin\Choice $authority = null): void
    {
        $this->authority = $authority;
    }

    /**
     * Get authority
     *
     * @return \App\Entity\Admin\Choice
     */
    public function getAuthority(): Choice
    {
        return $this->authority;
    }
}
