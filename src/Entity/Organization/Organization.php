<?php

namespace App\Entity\Organization;

use App\Entity\GedmoTrait;
use App\Entity\Admin\Admin;
use App\Entity\Admin\Options;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Organization\Company;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Organization
 *
 * @ORM\Table(name="sunshine_organization_organization", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="App\Repository\Organization\OrganizationRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 */
class Organization
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
     * 组织名称
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

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
     * 组织管理员
     * @var Admin
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Admin\Admin")
     * @ORM\JoinColumn(name="admin_id", referencedColumnName="id", nullable=true)
     */
    private $admin;

    /**
     * 公司类型
     * @var Options
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Admin\Options")
     * @ORM\JoinColumn(name="organization_type_options_id", referencedColumnName="id", nullable=true)
     */
    private $type;

    /**
     * 企业法人
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
     * 涵盖的公司
     * @var Company[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Company", mappedBy="organization")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $company;

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return __CLASS__;
    }

    /**
     * Pre persist event listener
     *
     * ORM\PrePersist
     */
    // public function beforeSave()
    // {
    //     $this->createdAt = new \DateTime('now', new \DateTimeZone('UTC'));
    //     $this->updatedAt = new \DateTime('now', new \DateTimeZone('UTC'));
    // }

    /**
     * Pre update event listener
     *
     * ORM\PreUpdate
     */
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
     *
     * @return Organization
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
    public function setOfficeAddress($officeAddress): void
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
     * Set admin
     *
     * @param App\Entity\Admin\Admin $admin
     */
    public function setAdmin(Admin $admin = null): void
    {
        $this->admin = $admin;
    }

    /**
     * Get admin
     *
     * @return App\Entity\Admin\Admin
     */
    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    /**
     * Set type
     *
     * @param App\Entity\Amin\Options $type
     */
    public function setType(Options $type = null): void
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return App\Entity\Amin\Options
     */
    public function getType(): ?Options
    {
        return $this->type;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->company = new ArrayCollection();
    }

    /**
     * Add company
     *
     * @param Company $company
     */
    public function addCompany(Company $company): void
    {
        $this->company[] = $company;
    }

    /**
     * Remove company
     *
     * @param Company $company
     */
    public function removeCompany(Company $company): void
    {
        $this->company->removeElement($company);
    }

    /**
     * Get company
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getCompany(): ArrayCollection
    {
        return $this->company;
    }
}
