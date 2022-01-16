<?php

namespace App\Entity;

use App\Repository\UeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UeRepository::class)
 */
class Ue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Filiere::class, inversedBy="ues")
     */
    private $filiere;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="ues")
     */
    private $niveau;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="ues")
     */
    private $matiere;

    /**
     * @ORM\OneToMany(targetEntity=NotesEtudiant::class, mappedBy="Ue")
     */
    private $notesEtudiants;

    public function __construct()
    {
        $this->notesEtudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFiliere(): ?Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(?Filiere $filiere): self
    {
        $this->filiere = $filiere;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * @return Collection|NotesEtudiant[]
     */
    public function getNotesEtudiants(): Collection
    {
        return $this->notesEtudiants;
    }

    public function addNotesEtudiant(NotesEtudiant $notesEtudiant): self
    {
        if (!$this->notesEtudiants->contains($notesEtudiant)) {
            $this->notesEtudiants[] = $notesEtudiant;
            $notesEtudiant->setUe($this);
        }

        return $this;
    }

    public function removeNotesEtudiant(NotesEtudiant $notesEtudiant): self
    {
        if ($this->notesEtudiants->removeElement($notesEtudiant)) {
            // set the owning side to null (unless already changed)
            if ($notesEtudiant->getUe() === $this) {
                $notesEtudiant->setUe(null);
            }
        }

        return $this;
    }
}
