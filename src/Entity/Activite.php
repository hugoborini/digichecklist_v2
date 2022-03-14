<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActiviteRepository::class)
 */
class Activite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameActivivite;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="activitesId")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoryId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCheck;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameActivivite(): ?string
    {
        return $this->nameActivivite;
    }

    public function setNameActivivite(string $nameActivivite): self
    {
        $this->nameActivivite = $nameActivivite;

        return $this;
    }

    public function getCategoryId(): ?Category
    {
        return $this->categoryId;
    }

    public function setCategoryId(?Category $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function getIsCheck(): ?bool
    {
        return $this->isCheck;
    }

    public function setIsCheck(bool $isCheck): self
    {
        $this->isCheck = $isCheck;

        return $this;
    }
}
