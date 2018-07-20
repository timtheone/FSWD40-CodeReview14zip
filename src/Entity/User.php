<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
// class User 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=190, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=190, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $password;

    /**
     * 
     * @ORM\Column(type="array")
     */
    private $roles;



    public function getId()
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        return array($this->roles);
        die;
    }

    public function setRoles($roles): self
    {
        $this->roles = $roles;

        return $this;
    }


    // public function getRoles()
    // {
    //     return array('ROLE_USER');
    // }
    public function getSalt()
    {
    }
    public function eraseCredentials()
    {
    }

//     public function serialize()
//     {
//         return serialize(array(
//             $this->id,
//             $this->username,
//             $this->email,
//             $this->password,
//             $this->roles
//         ));
//     }

//     public function unserialize($str)
//     {
//         list (
//             $this->id,
//             $this->username,
//             $this->email,
//             $this->password,
//             $this->roles
//     ) = unserialize($str, ['allowed_classes' => false]);
//   }
}
