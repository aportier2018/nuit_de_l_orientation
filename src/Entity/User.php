<?php

namespace App\Entity;

use App\Entity\Role;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *      fields={"email"},
 *      message="L'adresse mail existe déjà !")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

        /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *          min = 8,
     *          minMessage ="Votre mot de passe doit avoir 8 caractères minimum")
     */
    private $password;

    /**
    * @Assert\EqualTo(propertyPath="password", message="Vos mots de passe ne sont pas identiques")
     */
    public $confirm_password;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", mappedBy="users", cascade={"persist"})
     */
    private $userRoles;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Exponent", inversedBy="users")
     */
    private $archive;

    public function __construct()
    {
        $this->userRoles = new ArrayCollection();

        $role = new Role();
        $role->setTitle("ROLE_USER");
        $this->addUserRole($role);
        $this->archive = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

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

    public function eraseCredentials(){}
    
    public function getSalt(){}
    
    public function getRoles(){

        $roles = $this->userRoles->map(function($role){
            return $role->getTitle();
        })->toArray();

        $roles[]= 'ROLE_USER';
        
        return $roles;
    }

    public function getUsername(){
        return $this->email;
    }

    /**
     * @return Collection|Role[]
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles[] = $userRole;
            $userRole->addUser($this);
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        if ($this->userRoles->contains($userRole)) {
            $this->userRoles->removeElement($userRole);
            $userRole->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Exponent[]
     */
    public function getArchive(): Collection
    {
        return $this->archive;
    }

    public function addArchive(Exponent $archive): self
    {
        if (!$this->archive->contains($archive)) {
            $this->archive[] = $archive;
        }

        return $this;
    }

    public function removeArchive(Exponent $archive): self
    {
        if ($this->archive->contains($archive)) {
            $this->archive->removeElement($archive);
        }

        return $this;
    }

}
