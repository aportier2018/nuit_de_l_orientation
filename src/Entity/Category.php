<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
    private $namecat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Exponent", inversedBy="category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $exponent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCat(): ?string
    {
        return $this->namecat;
    }

    public function setNameCat(string $namecat): self
    {
        $this->name_cat = $namecat;

        return $this;
    }

    public function getExponent(): ?Exponent
    {
        return $this->exponent;
    }

    public function setExponent(?Exponent $exponent): self
    {
        $this->exponent = $exponent;

        return $this;
    }
}
