<?php

namespace App\Entity\Admin;

use App\Entity\GedmoTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Options 选项
 *
 * @ORM\Table(name="sunshine_admin_options", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="App\Repository\Admin\OptionsRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 */
class Options
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
     * @var string
     *
     * @ORM\Column(name="display_name", type="string", length=60)
     */
    private $displayName;

    /**
     * @var int
     *
     * @ORM\Column(name="value", type="integer", options={"unsigned"=true})
     */
    private $value;

    /**
     * @var Choice
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin\Choice", inversedBy="options")
     * @ORM\JoinColumn(name="choice_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $source;

    /**
     * @var int
     *
     * @ORM\Column(name="order_number", type="integer", options={"unsigned"=true})
     */
    private $orderNumber;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $enabledSearch;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", options={"unsigned"=true})
     */
    private $type;

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
        return $this->getDisplayName();
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
     * Set displayName
     *
     * @param string $displayName
     */
    public function setDisplayName($displayName): void
    {
        $this->displayName = $displayName;
    }

    /**
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * Set value
     *
     * @param integer $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue(): int
    {
        return $this->value;
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
    public function getOrderNumber(): int
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
     * Set enabledSearch
     *
     * @param boolean $enabledSearch
     */
    public function setEnabledSearch($enabledSearch): void
    {
        $this->enabledSearch = $enabledSearch;
    }

    /**
     * Get enabledSearch
     *
     * @return boolean
     */
    public function getEnabledSearch(): boolean
    {
        return $this->enabledSearch;
    }

    /**
     * Set type
     *
     * @param integer $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * Set source
     *
     * @param App\Entity\Admin\Choice $source
     */
    public function setSource(Choice $source = null): void
    {
        $this->source = $source;
    }

    /**
     * Get source
     *
     * @return App\Entity\Admin\Choice
     */
    public function getSource(): Choice
    {
        return $this->source;
    }
}
