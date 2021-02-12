<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilmRepository::class)
 */
class Film
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
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="film_id",cascade={"persist","remove"})
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=Acteur::class, mappedBy="film",cascade={"persist","remove"})
     */
    private $acteur_id;

    public function __construct()
    {
        $this->acteur_id = new ArrayCollection();
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Acteur[]
     */
    public function getActeurId(): Collection
    {
        return $this->acteur_id;
    }

    public function addActeurId(Acteur $acteurId): self
    {
        if (!$this->acteur_id->contains($acteurId)) {
            $this->acteur_id[] = $acteurId;
            $acteurId->setFilm($this);
        }

        return $this;
    }

    public function removeActeurId(Acteur $acteurId): self
    {
        if ($this->acteur_id->removeElement($acteurId)) {
            // set the owning side to null (unless already changed)
            if ($acteurId->getFilm() === $this) {
                $acteurId->setFilm(null);
            }
        }

        return $this;
    }
}
