<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 12/12/2017
 * Time: 15:31
 */

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique;


/**
 * Class User
 * @package AppBundle\Document
 * @ODM\Document
 * @Unique("username")
 * @Unique("email")
 */
class User implements UserInterface
{
    public static $ROLES = [
        'ROLE_RESTAURANT_CV' => 'ROLE_RESTAURANT_CV',
        'ROLE_RESTAURANT_MH' => 'ROLE_RESTAURANT_MH',
        'ROLE_RESTAURANT_DR' => 'ROLE_RESTAURANT_DR',
        'ROLE_SUPERVISOR' => 'ROLE_SUPERVISOR',
        'ROLE_FRANCHISE' => 'ROLE_FRANCHISE',
        'ROLE_ADMIN' => 'ROLE_ADMIN'
    ];

    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     message = "user.username.validator"
     * )
     * @ODM\UniqueIndex()
     */
    private $username;

    /**
     * @ODM\Field(type="string")
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "user.email.validator",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @ODM\Field(type="string")
     */
    private $password;

    /**
     * @ODM\Field(type="collection")
     * @Assert\NotBlank(groups={"registration"})
     */
    private $roles;

    /**
     * @var \AppBundle\Document\Restaurant
     * @ODM\ReferenceMany(targetDocument="Restaurant")
     * @Assert\NotBlank(groups={"registration"})
     */
    private $restaurants;

    private $plainPassword;

    public function __construct()
    {
        $this->roles = [];
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return \AppBundle\Document\Restaurant[]
     */
    public function getRestaurants()
    {
        return $this->restaurants;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param \AppBundle\Document\Restaurant $restaurant
     */
    public function addRestaurant(\AppBundle\Document\Restaurant $restaurant)
    {
        $this->restaurants[] = $restaurant;
    }

    /**
     * @param \AppBundle\Document\Restaurant[] $restaurant
     */
    public function setRestaurants($restaurants)
    {
        $this->restaurants = $restaurants;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    public function getRoles()
    {
        return empty($this->roles)? ['ROLE_USERS']: $this->roles;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}