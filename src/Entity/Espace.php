<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EspaceRepository")
 */
class Espace
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
    private $name_space;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSpace(): ?string
    {
        return $this->name_space;
    }

    public function setNameSpace(string $name_space): self
    {
        $this->name_space = $name_space;

        return $this;
    }
}
