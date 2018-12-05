<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MotcleRepository")
 */
class Motcle
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
    private $namemc;


    // /**
    //  * @ORM\ManyToMany(targetEntity="App\Entity\Exponent", mappedBy="motcle")
    //  */
    // private $exponent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Exponent", mappedBy="mc")
     */
    private $nameexp;

    public function __construct()
    {
        $this->exponents = new ArrayCollection();
        $this->exponent = new ArrayCollection();
        $this->nameexp = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameMc(): ?string
    {
        return $this->namemc;
    }

    public function setNameMc(string $namemc): self
    {
        $this->namemc = $namemc;

        return $this;
    }

    /**
     * @return Collection|Exponent[]
     */
    public function getExponents(): Collection
    {
        return $this->exponents;
    }

    public function addExponent(Exponent $exponent): self
    {
        if (!$this->exponents->contains($exponent)) {
            $this->exponents[] = $exponent;
            $exponent->addMotcle($this);
        }

        return $this;
    }

    public function removeExponent(Exponent $exponent): self
    {
        if ($this->exponents->contains($exponent)) {
            $this->exponents->removeElement($exponent);
            $exponent->removeMotcle($this);
        }

        return $this;
    }

    /**
     * @return Collection|Exponent[]
     */
    public function getExponent(): Collection
    {
        return $this->exponent;
    }

    /**
     * @return Collection|Exponent[]
     */
    public function getNameexp(): Collection
    {
        return $this->nameexp;
    }

    public function addNameexp(Exponent $nameexp): self
    {
        if (!$this->nameexp->contains($nameexp)) {
            $this->nameexp[] = $nameexp;
            $nameexp->setMc($this);
        }

        return $this;
    }

    public function removeNameexp(Exponent $nameexp): self
    {
        if ($this->nameexp->contains($nameexp)) {
            $this->nameexp->removeElement($nameexp);
            // set the owning side to null (unless already changed)
            if ($nameexp->getMc() === $this) {
                $nameexp->setMc(null);
            }
        }

        return $this;
    }
}
