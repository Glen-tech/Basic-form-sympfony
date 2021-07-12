<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="symfony_app_users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=25)
     */
    private $username;

    /**
     * @ORM\Column(type="text", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="text", length=254)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;
	

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }

    public function getUsername()
    {
        return $this->username;
    }
	
	public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }
	
	public function setPassword($password)
    {
		$this->password = $password;
    }
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            //see section on salt below
            $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            /*see section on salt below*/
            $this->salt
        ) = unserialize($serialized, array('allowed_classes' => false));
    }
}

?>