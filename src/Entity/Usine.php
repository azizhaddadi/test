<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use App\Repository\UsineRepository;
use ContainerWF4JVIf\getUsineRepositoryService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: UsineRepository::class)]
class Usine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $codepostal = null;

    /**
     * @var Collection<int, Voiture>
     */
    #[ORM\OneToMany(targetEntity: Voiture::class, mappedBy: 'usine')]
    private Collection $Voiture;

    public function __construct()
    {
        $this->Voiture = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCodepostal(): ?int
    {
        return $this->codepostal;
    }

    public function setcodepostal(int $codepostal): static
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * @return Collection<int, voiture>
     */
    public function getVoiture(): Collection
    {
        return $this->Voiture;
    }

    public function addVoiture(voiture $voiture): static
    {
        if (!$this->Voiture->contains($voiture)) {
            $this->Voiture->add($voiture);
            $voiture->setUsine($this);
        }

        return $this;
    }

    public function removeVoiture(voiture $voiture): static
    {
        if ($this->Voiture->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getUsine() === $this) {
                $voiture->setUsine(null);
            }
        }

        return $this;
    }
}
