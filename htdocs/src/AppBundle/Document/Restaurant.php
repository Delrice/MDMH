<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 12/12/2017
 * Time: 15:48
 */

namespace AppBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class Restaurant
 * @package AppBundle\Document
 * @ODM\Document(repositoryClass="AppBundle\Document\Repositories\RestaurantRepository")
 * @ODM\HasLifecycleCallbacks()
 */
class Restaurant
{
    use ExtendedProperties\CreatedAtTrait;
    use ExtendedProperties\UpdatedAtTrait;

    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     */
    private $name;

    /**
     * @ODM\Field(type="string")
     */
    private $identifier;

    /**
     * @var \AppBundle\Document\User[]
     * @ODM\ReferenceMany(targetDocument="User", mappedBy="restaurants")
     */
    private $users;

    /**
     * @var \AppBundle\Document\Budget[]
     * @ODM\ReferenceMany(targetDocument="Budget", mappedBy="restaurant", sort={"year"="ASC"})
     */
    private $budgets;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param mixed $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * @return User[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @return Budget[]
     */
    public function getBudgets()
    {
        return $this->budgets;
    }

    public function __toString()
    {
        return $this->name;
    }
}