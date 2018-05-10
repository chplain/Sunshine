<?php

namespace App\Entity\Organization;

use App\Entity\GedmoTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Tree\Node as GedmoNode;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * BusinessUnit 部门
 *
 * @ORM\Table(name="sunshine_organization_business_unit",
 *     options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"},
 *     indexes={
 *         @ORM\Index(name="idx_business_unit_name", columns={"name"}),
 *         @ORM\Index(name="idx_business_unit_enabled", columns={"enabled"})
 *     })
 * @ORM\Entity(repositoryClass="App\Repository\Organization\BusinessUnitRepository")
 * @UniqueEntity(
 *     fields={"company", "name"},
 *     errorPath="name",
 *     message="organization.form.bu.nameExist"
 * )
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\Tree(type="nested")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 */
class BusinessUnit implements GedmoNode
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
     * 部门名称
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * 部门代码
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10, nullable=true)
     */
    private $code;

    /**
     * 排序号
     * @var int
     *
     * @ORM\Column(name="order_number", type="integer", options={"unsigned"=true}, nullable=true)
     */
    private $orderNumber;

    /**
     * 开启状态
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $enabled;

    /**
     * 是否创建了部门空间
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $createdSpace;

    /**
     * 部门主管
     * @var User
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Organization\User")
     * @ORM\JoinColumn(name="bu_manager_user_id", referencedColumnName="id", nullable=true)
     */
    private $manager;

    /**
     * 部门分管领导
     * @var User
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Organization\User")
     * @ORM\JoinColumn(name="pre_manager", referencedColumnName="id", nullable=true)
     */
    private $preManager;

    /**
     * 部门管理员
     * @var User
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Organization\User")
     * @ORM\JoinColumn(name="bu_admin", referencedColumnName="id", nullable=true)
     */
    private $businessUnitAdmin;

    /**
     * 部门公文收发员
     * @var User
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Organization\User")
     * @ORM\JoinColumn(name="document_receiver", referencedColumnName="id", nullable=true)
     */
    private $documentReceiver;

    /**
     * Todo 部门岗位
     * @var $title
     */
    private $title;

    /**
     * 部门描述
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * 部门员工
     * @var User[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Organization\User", mappedBy="businessUnit")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $users;

    /**
     * 部门工作组
     * @var WorkGroup[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Organization\WorkGroup", mappedBy="businessUnit")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $groups;

    /**
     * 部门所属公司
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization\Company", inversedBy="businessUnit")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $company;

    /**
     * 上级部门
     * @var BusinessUnit
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization\BusinessUnit", inversedBy="children", fetch="LAZY")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     * @Gedmo\TreeParent
     */
    private $parent;

    /**
     * 下级部门
     * @var BusinessUnit[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Organization\BusinessUnit", mappedBy="parent", fetch="LAZY")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $children;

    /**
     * 根部门
     * @var BusinessUnit
     *
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization\BusinessUnit")
     * @ORM\JoinColumn(name="root", referencedColumnName="id", nullable=true)
     */
    private $root;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Gedmo\TreeLeft
     */
    private $lft;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Gedmo\TreeLevel
     */
    private $lvl;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Gedmo\TreeRight
     */
    private $rgt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return __CLASS__;
    }

    // /**
    //  * Pre persist event listener
    //  *
    //  * ORM\PrePersist
    //  */
    // public function beforeSave()
    // {
    //     $this->createdAt = new \DateTime('now', new \DateTimeZone('UTC'));
    //     $this->updatedAt = new \DateTime('now', new \DateTimeZone('UTC'));
    // }

    // /**
    //  * Pre update event listener
    //  *
    //  * ORM\PreUpdate
    //  */
    // public function beforeUpdate()
    // {
    //     $this->updatedAt = new \DateTime('now', new \DateTimeZone('UTC'));
    // }

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
     *
     * @return BusinessUnit
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
     * Set code
     *
     * @param string $code
     *
     * @return BusinessUnit
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return BusinessUnit
     */
    public function setOrderNumber($orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * Get orderNumber
     *
     * @return integer
     */
    public function getOrderNumber(): ?int
    {
        return $this->orderNumber;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return BusinessUnit
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
    public function getEnabled(): boolean
    {
        return $this->enabled;
    }

    /**
     * Set createdSpace
     *
     * @param boolean $createdSpace
     *
     * @return BusinessUnit
     */
    public function setCreatedSpace($createdSpace): void
    {
        $this->createdSpace = $createdSpace;
    }

    /**
     * Get createSpace
     *
     * @return boolean
     */
    public function getCreatedSpace(): boolean
    {
        return $this->createdSpace;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return BusinessUnit
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     */
    public function setLft($lft): void
    {
        $this->lft = $lft;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft(): ?int
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     */
    public function setLvl($lvl): void
    {
        $this->lvl = $lvl;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl(): ?int
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     */
    public function setRgt($rgt): void
    {
        $this->rgt = $rgt;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt(): ?int
    {
        return $this->rgt;
    }

    /**
     * Set manager
     *
     * @param App\Entity\Organization\User $manager
     */
    public function setManager(User $manager = null): void
    {
        $this->manager = $manager;
    }

    /**
     * Get manager
     *
     * @return App\Entity\Organization\User
     */
    public function getManager(): ?User
    {
        return $this->manager;
    }

    /**
     * Set preManager
     *
     * @param App\Entity\Organization\User $preManager
     */
    public function setPreManager(User $preManager = null): void
    {
        $this->preManager = $preManager;
    }

    /**
     * Get preManager
     *
     * @return App\Entity\Organization\User
     */
    public function getPreManager(): ?User
    {
        return $this->preManager;
    }

    /**
     * Set businessUnitAdmin
     *
     * @param App\Entity\Organization\User $businessUnitAdmin
     */
    public function setBusinessUnitAdmin(User $businessUnitAdmin = null): void
    {
        $this->businessUnitAdmin = $businessUnitAdmin;
    }

    /**
     * Get businessUnitAdmin
     *
     * @return App\Entity\Organization\User
     */
    public function getBusinessUnitAdmin(): ?User
    {
        return $this->businessUnitAdmin;
    }

    /**
     * Set documentReceiver
     *
     * @param App\Entity\Organization\User $documentReceiver
     */
    public function setDocumentReceiver(User $documentReceiver = null): void
    {
        $this->documentReceiver = $documentReceiver;
    }

    /**
     * Get documentReceiver
     *
     * @return App\Entity\Organization\User
     */
    public function getDocumentReceiver(): ?User
    {
        return $this->documentReceiver;
    }

    /**
     * Set company
     *
     * @param App\Entity\Organization\Company $company
     */
    public function setCompany(Company $company = null): void
    {
        $this->company = $company;
    }

    /**
     * Get company
     *
     * @return App\Entity\Organization\Company
     */
    public function getCompany(): ?Company
    {
        return $this->company;
    }

    /**
     * Set parent
     *
     * @param App\Entity\Organization\BusinessUnit $parent
     *
     * @return BusinessUnit
     */
    public function setParent(BusinessUnit $parent = null): void
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return App\Entity\Organization\BusinessUnit
     */
    public function getParent(): ?BusinessUnit
    {
        return $this->parent;
    }

    /**
     * Add child
     *
     * @param App\Entity\Organization\BusinessUnit $child
     *
     * @return BusinessUnit
     */
    public function addChild(BusinessUnit $child): void
    {
        $this->children[] = $child;
    }

    /**
     * Remove child
     *
     * @param App\Entity\Organization\BusinessUnit $child
     */
    public function removeChild(BusinessUnit $child): void
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getChildren(): ArrayCollection
    {
        return $this->children;
    }

    /**
     * Set root
     *
     * @param App\Entity\Organization\BusinessUnit $root
     */
    public function setRoot(BusinessUnit $root = null): void
    {
        $this->root = $root;
    }

    /**
     * Get root
     *
     * @return App\Entity\Organization\BusinessUnit
     */
    public function getRoot(): ?BusinessUnit
    {
        return $this->root;
    }

    /**
     * Add user
     *
     * @param App\Entity\Organization\User $user
     *
     * @return BusinessUnit
     */
    public function addUser(User $user): void
    {
        $this->users[] = $user;
    }

    /**
     * Remove user
     *
     * @param App\Entity\Organization\User $user
     */
    public function removeUser(User $user): void
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getUsers(): ArrayCollection
    {
        return $this->users;
    }

    /**
     * Add group
     *
     * @param App\Entity\Organization\WorkGroup $group
     */
    public function addGroup(WorkGroup $group): void
    {
        $this->groups[] = $group;
    }

    /**
     * Remove group
     *
     * @param App\Entity\Organization\WorkGroup $group
     */
    public function removeGroup(WorkGroup $group): void
    {
        $this->groups->removeElement($group);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getGroups(): ArrayCollection
    {
        return $this->groups;
    }
}
