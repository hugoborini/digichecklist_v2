<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $nameCategory;

    /**
     * @ORM\OneToMany(targetEntity=Activite::class, mappedBy="categoryId")
     */
    private $activitesId;

    public function __construct()
    {
        $this->activitesId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategory(): ?string
    {
        return $this->nameCategory;
    }

    public function setNameCategory(string $nameCategory): self
    {
        $this->nameCategory = $nameCategory;

        return $this;
    }

    /**
     * @return Collection<int, Activite>
     */
    public function getActivitesId(): Collection
    {
        return $this->activitesId;
    }

    public function addActivitesId(Activite $activitesId): self
    {
        if (!$this->activitesId->contains($activitesId)) {
            $this->activitesId[] = $activitesId;
            $activitesId->setCategoryId($this);
        }

        return $this;
    }

    public function removeActivitesId(Activite $activitesId): self
    {
        if ($this->activitesId->removeElement($activitesId)) {
            // set the owning side to null (unless already changed)
            if ($activitesId->getCategoryId() === $this) {
                $activitesId->setCategoryId(null);
            }
        }

        return $this;
    }
}
