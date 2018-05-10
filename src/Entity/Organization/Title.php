<?php

namespace App\Entity\Organization;

use App\Entity\GedmoTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Title 职位
 *
 * @ORM\Table(name="sunshine_organization_title", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="App\Repository\Organization\TitleRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 */
class Title
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
     * 岗位名称
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * 岗位代码
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=20, nullable=true)
     */
    private $code;

    /**
     * 岗位类型
     * @var Options
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin\Options")
     * @ORM\JoinColumn(name="title_type_options_id", referencedColumnName="id", nullable=true)
     */
    private $type;

    /**
     * 排序序号
     * @var int
     *
     * @ORM\Column(name="order_number", type="integer", options={"unsigned"=true})
     */
    private $orderNumber;

    /**
     * 是否开启
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * 备注，描述
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * 此岗位用户
     * @var User[]|ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\Organization\User",
     *     mappedBy="title",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $users;

    /**
     * 第二岗位为此岗位的用户
     * @var User[]|ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\Organization\User",
     *     mappedBy="secondTitle", orphanRemoval=true,
     *     cascade={"persist"}
     * )
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $secondTitleUsers;

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
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->secondTitleUsers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set code
     *
     * @param string $code
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
    public function getOrderNumber() : ?integer
    {
        return $this->orderNumber;
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
    public function getEnabled(): boolean
    {
        return $this->enabled;
    }

    /**
     * Set description
     *
     * @param string $description
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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param \App\Entity\Admin\Options $type
     */
    public function setType(Options $type = null): void
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return \App\Entity\Admin\Options
     */
    public function getType(): ?Options
    {
        return $this->type;
    }

    /**
     * Add user
     *
     * @param \App\Entity\Organization\User $user
     */
    public function addUser(User $user): void
    {
        $this->users[] = $user;
    }

    /**
     * Remove user
     *
     * @param \App\Entity\Organization\User $user
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
     * Add secondTitleUser
     *
     * @param \App\Entity\Organization\User $secondTitleUser
     */
    public function addSecondTitleUser(User $secondTitleUser): void
    {
        $this->secondTitleUsers[] = $secondTitleUser;
    }

    /**
     * Remove secondTitleUser
     *
     * @param \App\Entity\Organization\User $secondTitleUser
     */
    public function removeSecondTitleUser(User $secondTitleUser): void
    {
        $this->secondTitleUsers->removeElement($secondTitleUser);
    }

    /**
     * Get secondTitleUsers
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getSecondTitleUsers(): ArrayCollection
    {
        return $this->secondTitleUsers;
    }
}
