<?php

namespace App\Entity\Admin;

use App\Entity\GedmoTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Choice
 *
 * @ORM\Table(name="sunshine_admin_choice", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="App\Repository\Admin\ChoiceRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 */
class Choice
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var Options[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Admin\Options", mappedBy="source")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $options;

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

    public function __construct()
    {
        $this->options = new ArrayCollection();
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
     * Add option
     *
     * @param \App\Entity\Admin\Options $option
     */
    public function addOption(Options $option): void
    {
        $this->options[] = $option;
    }

    /**
     * Remove option
     *
     * @param \App\Entity\Admin\Options $option
     */
    public function removeOption(Options $option): void
    {
        $this->options->removeElement($option);
    }

    /**
     * Get options
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }
}
