<?php

namespace App\Entity\Organization;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\GedmoTrait;

/**
 * @ORM\Table(name="sunshine_organization_user", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="App\Repository\Organization\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 * @UniqueEntity(fields={"username"}, message="organization.user.name.exit")
 * @UniqueEntity(fields={"phone"}, message="organization.user.phone.exit")
 */
class User implements AdvancedUserInterface, \Serializable
{
    use GedmoTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 用户名
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=25)
     */
    private $username;

    /**
     * phone number, also as user identifier
     * 电话号码，也可以作为用户名使用
     *
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=30, unique=true)
     * @Assert\NotBlank()
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $password;

    /**
     * email, also as user identifier
     * 邮箱，也可以作为用户名使用
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=60, unique=true, nullable=true)
     */
    private $email;

    /**
     * 用户状态
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * 真实姓名
     * @var string
     *
     * @ORM\Column(name="real_name", type="string", length=50, nullable=true)
     * @Assert\Length(
     *     min = 4,
     *     max = 50,
     *     minMessage = "sunshine.user.real_name.length_min",
     *     maxMessage = "sunshine.user.real_name.length_max"
     * )
     */
    private $realName;

    /**
     * Todo 为未来的多语言版本做准备
     * @var
     */
    private $locale;

    /**
     * Todo 个人角色，如某部门管理员
     */
    private $personalRoles;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="json_array", nullable=true)
     */
    protected $roles = [];

    /**
     * 部门
     * @var BusinessUnit
     *
     * @ORM\ManyToOne(targetEntity="BusinessUnit", inversedBy="users", cascade={"persist"})
     * @ORM\JoinColumn(name="user_business_unit_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $businessUnit;

    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="users")
     * @ORM\JoinColumn(name="user_company_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $company;

    /**
     * 员工编号
     * @var string
     *
     * @ORM\Column(name="employee_number", type="string", length=255, nullable=true)
     */
    private $employeeNumber;

    /**
     * 排序号
     * @var int
     *
     * @ORM\Column(name="order_number", type="integer", options={"unsigned"=true}, nullable=true)
     */
    private $orderNumber;

    /**
     * 主岗
     * @var Title
     *
     * @ORM\ManyToOne(targetEntity="Title", inversedBy="users", cascade="persist")
     * @ORM\JoinColumn(name="title", referencedColumnName="id", onDelete="SET NULL")
     */
    private $title;

    /**
     * 副岗
     * @var Second Title
     *
     * @ORM\ManyToOne(targetEntity="Title", inversedBy="secondTitleUsers", cascade="persist")
     * @ORM\JoinColumn(name="second_title", referencedColumnName="id", onDelete="SET NULL")
     */
    private $secondTitle;

    /**
     * 职务级别
     * @var ServiceGrade
     *
     * @ORM\ManyToOne(targetEntity="ServiceGrade", inversedBy="users", cascade="persist")
     * @ORM\JoinColumn(name="service_grade", referencedColumnName="id", onDelete="SET NULL")
     */
    private $serviceGrade;

    /**
     * 员工类型
     * @var Choice
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Admin\Choice")
     * @ORM\JoinColumn(name="type_choice_id", referencedColumnName="id", nullable=true)
     */
    private $type;

    /**
     * Todo 头像
     * @var
     */
    private $avatar;

    /**
     * 性别
     * @var Choice
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Admin\Choice")
     * @ORM\JoinColumn(name="gender_choice_id", referencedColumnName="id", nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Assert\Length(
     *     max = 30,
     *     maxMessage = "sunshine.user.education.length_max"
     * )
     */
    private $education;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     * @Assert\Date(
     *     message = "sunshine.user.birthday.date"
     * )
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, nullable=true)
     * @Assert\Length(
     *     min = 2,
     *     max = 255,
     *     minMessage = "sunshine.string.length_min",
     *     maxMessage = "sunshine.user.address.length_max"
     * )
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\Country(
     *     message = "sunshine.user.citizenship.country"
     * )
     */
    private $citizenship;

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return __CLASS__;
    }

    public function __construct()
    {
        $this->isActive = true;
    }

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired(): bool
    {
        return true;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked() : bool
    {
        return true;
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired(): bool
    {
        return true;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return $this->isActive;
    }

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     * {@inheritdoc}
     */
    public function serialize(): ?string
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
        ));
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     * {@inheritdoc}
     */
    public function unserialize($serialized): string
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            ) = unserialize($serialized);
    }

    /**
     * 获取用户角色
     * {@inheritdoc}
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        // 保证每个用户至少有一个角色
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * {@inheritdoc}
     */
    public function getSalt(): ?string
    {
        // See "Do you need to use a Salt?" at https://symfony.com/doc/current/cookbook/security/entity_provider.html
        // we're using bcrypt in security.yml to encode the password, so
        // the salt value is built-in and you don't have to generate one

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
        // if you had a plainPassword property, you'd nullify it here
        // $this->plainPassword = null;
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
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return string
     */
    public function getRealName(): string
    {
        return $this->realName;
    }

    /**
     * @param string $realName
     */
    public function setRealName(string $realName)
    {
        $this->realName = $realName;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return mixed
     */
    public function getPersonalRoles()
    {
        return $this->personalRoles;
    }

    /**
     * @param mixed $personalRoles
     */
    public function setPersonalRoles($personalRoles)
    {
        $this->personalRoles = $personalRoles;
    }

    /**
     * @return BusinessUnit
     */
    public function getBusinessUnit(): BusinessUnit
    {
        return $this->businessUnit;
    }

    /**
     * @param BusinessUnit $businessUnit
     */
    public function setBusinessUnit(BusinessUnit $businessUnit)
    {
        $this->businessUnit = $businessUnit;
    }

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getEmployeeNumber(): string
    {
        return $this->employeeNumber;
    }

    /**
     * @param string $employeeNumber
     */
    public function setEmployeeNumber(string $employeeNumber)
    {
        $this->employeeNumber = $employeeNumber;
    }

    /**
     * @return int
     */
    public function getOrderNumber(): int
    {
        return $this->orderNumber;
    }

    /**
     * @param int $orderNumber
     */
    public function setOrderNumber(int $orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @return Title
     */
    public function getTitle(): Title
    {
        return $this->title;
    }

    /**
     * @param Title $title
     */
    public function setTitle(Title $title)
    {
        $this->title = $title;
    }

    /**
     * @return Second
     */
    public function getSecondTitle(): Second
    {
        return $this->secondTitle;
    }

    /**
     * @param Second $secondTitle
     */
    public function setSecondTitle(Second $secondTitle)
    {
        $this->secondTitle = $secondTitle;
    }

    /**
     * @return ServiceGrade
     */
    public function getServiceGrade(): ServiceGrade
    {
        return $this->serviceGrade;
    }

    /**
     * @param ServiceGrade $serviceGrade
     */
    public function setServiceGrade(ServiceGrade $serviceGrade)
    {
        $this->serviceGrade = $serviceGrade;
    }

    /**
     * @return Choice
     */
    public function getType(): Choice
    {
        return $this->type;
    }

    /**
     * @param Choice $type
     */
    public function setType(Choice $type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return Choice
     */
    public function getGender(): Choice
    {
        return $this->gender;
    }

    /**
     * @param Choice $gender
     */
    public function setGender(Choice $gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getEducation(): string
    {
        return $this->education;
    }

    /**
     * @param string $education
     */
    public function setEducation(string $education)
    {
        $this->education = $education;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday(): \DateTime
    {
        return $this->birthday;
    }

    /**
     * @param \DateTime $birthday
     */
    public function setBirthday(\DateTime $birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getCitizenship(): string
    {
        return $this->citizenship;
    }

    /**
     * @param string $citizenship
     */
    public function setCitizenship(string $citizenship)
    {
        $this->citizenship = $citizenship;
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }
}
