<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 21/12/2017
 * Time: 10:30
 */

namespace AppBundle\Document\ExtendedProperties;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

trait UpdatedAtTrait
{
    /**
     * @ODM\Field(type="date")
     */
    private $updatedAt;

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     * @ODM\PrePersist()
     * @ODM\PreUpdate()
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }
}