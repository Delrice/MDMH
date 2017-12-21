<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 21/12/2017
 * Time: 10:30
 */

namespace AppBundle\Document\ExtendedProperties;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

trait CreatedAtTrait
{
    /**
     * @ODM\Field(type="date")
     */
    private $createdAt;

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @ODM\PrePersist()
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
    }
}