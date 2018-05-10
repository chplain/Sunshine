<?php

namespace App\Entity\Organization;

use App\Entity\GedmoTrait;
use App\Entity\Admin\Choice;
use App\Entity\Admin\Options;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Company 公司
 *
 * @ORM\Table(name="sunshine_organization_company", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="App\Repository\Organization\CompanyRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 */
class Company
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
     * 公司名称
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * 公司代码
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
     * 外文名称
     * @var string
     *
     * @ORM\Column(name="foreign_name", type="string", length=255, nullable=true)
     */
    private $foreignName;

    /**
     * 公司简称
     * @var string
     *
     * @ORM\Column(name="alias_name", type="string", length=20, nullable=true)
     */
    private $alias;

    /**
     * 公司类型
     * @var Options
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin\Options")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;

    /**
     * 法人
     * @var string
     *
     * @ORM\Column(name="legal_person", type="string", length=50, nullable=true)
     */
    private $legalPerson;

    /**
     * 地址
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * 邮政编码
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=20, nullable=true)
     */
    private $zipCode;

    /**
     * 电话
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=30, nullable=true)
     */
    private $phone;

    /**
     * 传真
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=30, nullable=true)
     */
    private $fax;

    /**
     * 网站
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=60, nullable=true)
     */
    private $website;

    /**
     * 邮箱
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * 办公地址
     * @var string
     *
     * @ORM\Column(name="office_address", type="string", length=255, nullable=true)
     */
    private $officeAddress;

    /**
     * 描述
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true, nullable=true)
     */
    private $description;

    /**
     * 所属组织
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization\Organization", inversedBy="company")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $organization;

    /**
     * 旗下部门
     * @var BusinessUnit[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Organization\BusinessUnit", mappedBy="company")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $businessUnit;

    /**
     * 旗下员工
     * @var User[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Organization\User", mappedBy="company", fetch="LAZY")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $users;

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

    public function __toString()
    {
        return (string) $this->getName();
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
        $this->businessUnit = new ArrayCollection();
        $this->users = new ArrayCollection();
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
     * Set foreignName
     *
     * @param string $foreignName
     */
    public function setForeignName($foreignName): void
    {
        $this->foreignName = $foreignName;
    }

    /**
     * Get foreignName
     *
     * @return string
     */
    public function getForeignName(): ?string
    {
        return $this->foreignName;
    }

    /**
     * Set alias
     *
     * @param string $alias
     */
    public function setAlias($alias): void
    {
        $this->alias = $alias;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * Set legalPerson
     *
     * @param string $legalPerson
     */
    public function setLegalPerson($legalPerson): void
    {
        $this->legalPerson = $legalPerson;
    }

    /**
     * Get legalPerson
     *
     * @return string
     */
    public function getLegalPerson(): ?string
    {
        return $this->legalPerson;
    }

    /**
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     */
    public function setZipCode($zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Set fax
     *
     * @param string $fax
     */
    public function setFax($fax): void
    {
        $this->fax = $fax;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * Set website
     *
     * @param string $website
     */
    public function setWebsite($website): void
    {
        $this->website = $website;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * Set mail
     *
     * @param string $mail
     */
    public function setMail($mail): void
    {
        $this->mail = $mail;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * Set officeAddress
     *
     * @param string $officeAddress
     */
    public function setOfficeAddress($officeAddress): ?string
    {
        $this->officeAddress = $officeAddress;
    }

    /**
     * Get officeAddress
     *
     * @return string
     */
    public function getOfficeAddress(): ?string
    {
        return $this->officeAddress;
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
     * Set organization
     *
     * @param \App\Entity\Organization\Organization $organization
     */
    public function setOrganization(Organization $organization = null): void
    {
        $this->organization = $organization;
    }

    /**
     * Get organization
     *
     * @return \App\Entity\Organization\Organization
     */
    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    /**
     * Add businessUnit
     *
     * @param \App\Entity\Organization\BusinessUnit $businessUnit
     */
    public function addBusinessUnit(BusinessUnit $businessUnit): void
    {
        $this->businessUnit[] = $businessUnit;
    }

    /**
     * Remove businessUnit
     *
     * @param \App\Entity\Organization\BusinessUnit $businessUnit
     */
    public function removeBusinessUnit(BusinessUnit $businessUnit): void
    {
        $this->businessUnit->removeElement($businessUnit);
    }

    /**
     * Get businessUnit
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getBusinessUnit(): ArrayCollection
    {
        return $this->businessUnit;
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
    public function getOrderNumber(): ?int
    {
        return $this->orderNumber;
    }
}
