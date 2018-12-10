<?php

namespace App\Entity;
use App\Entity\Exponent;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExponentRepository")
 */
class Exponent
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
    private $nameexp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $activity;

    // // /**
    // //  * @ORM\ManyToMany(targetEntity="App\Entity\Motcle", inversedBy="exponent")
    // //  */
    //  private $motcle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Motcle", inversedBy="nameexp")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mc;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="archive")
     */
    private $users;

    // /**
    //  * @ORM\ManyToOne(targetEntity="App\Entity\Motcle", inversedBy="exponents")
    //  * @ORM\JoinColumn(nullable=false)
    //  */
    // private $mc;



    public function __construct()
    {
        $this->motcle = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameExp(): ?string
    {
        return $this->nameexp;
    }

    public function setNameExp(string $nameexp): self
    {
        $this->nameexp = $nameexp;

        return $this;
    }

    public function getActivity(): ?string
    {
        return $this->activity;
    }

    public function setActivity(string $activity): self
    {
        $this->activity = $activity;
        return $this;
    }

    public function getMotcle(): ?Motcle
    {
        return $this->mc;
    }

    public function setMotcle(?Motcle $mc): self
    {
        $this->mc = $mc;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addArchive($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeArchive($this);
        }

        return $this;
    }

}
