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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Film::class, mappedBy="category",cascade={"persist","remove"})
     */
    private $film_id;

    public function __construct()
    {
        $this->film_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilmId(): Collection
    {
        return $this->film_id;
    }

    public function addFilmId(Film $filmId): self
    {
        if (!$this->film_id->contains($filmId)) {
            $this->film_id[] = $filmId;
            $filmId->setCategory($this);
        }

        return $this;
    }

    public function removeFilmId(Film $filmId): self
    {
        if ($this->film_id->removeElement($filmId)) {
            // set the owning side to null (unless already changed)
            if ($filmId->getCategory() === $this) {
                $filmId->setCategory(null);
            }
        }

        return $this;
    }
}
