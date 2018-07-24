<?php

namespace App\Entity;

use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;

trait GedmoTrait
{
    /**
     * 挂载软删除能力
     * 增加 deletedAt 字段
     */
    use SoftDeleteableEntity;

    /**
     * 挂载时间节点能力
     * 增加 createdAt, updatedAt 字段
     */
    use TimestampableEntity;

    /**
     * 挂载问责性能力
     * 增加 createdBy, updatedBy 字段
     */
    use BlameableEntity;

    /**
     * Pre persist event listener
     *
     * @ORM\PrePersist
     */
    public function beforeSave()
    {
        $this->createdAt = new \DateTime('now', new \DateTimeZone('UTC'));
        $this->updatedAt = new \DateTime('now', new \DateTimeZone('UTC'));
    }

    /**
     * Pre update event listener
     *
     * @ORM\PreUpdate
     */
    public function beforeUpdate()
    {
        $this->updatedAt = new \DateTime('now', new \DateTimeZone('UTC'));
    }
}
