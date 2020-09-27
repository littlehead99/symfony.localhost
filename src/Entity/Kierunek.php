<?php

namespace App\Entity;

use App\Repository\KierunekRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KierunekRepository::class)
 */
class Kierunek
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
    private $nazwa;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="kierunek")
     */
    private $Studenci;

    /**
     * @ORM\OneToMany(targetEntity=Przedmiot::class, mappedBy="kierunek")
     */
    private $Przedmioty;

    public function __construct()
    {
        $this->Studenci = new ArrayCollection();
        $this->Przedmioty = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nazwa;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(string $nazwa): self
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudenci(): Collection
    {
        return $this->Studenci;
    }

    public function addStudenci(Student $studenci): self
    {
        if (!$this->Studenci->contains($studenci)) {
            $this->Studenci[] = $studenci;
            $studenci->setKierunek($this);
        }

        return $this;
    }

    public function removeStudenci(Student $studenci): self
    {
        if ($this->Studenci->contains($studenci)) {
            $this->Studenci->removeElement($studenci);
            // set the owning side to null (unless already changed)
            if ($studenci->getKierunek() === $this) {
                $studenci->setKierunek(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Przedmiot[]
     */
    public function getPrzedmioty(): Collection
    {
        return $this->Przedmioty;
    }

    public function addPrzedmioty(Przedmiot $przedmioty): self
    {
        if (!$this->Przedmioty->contains($przedmioty)) {
            $this->Przedmioty[] = $przedmioty;
            $przedmioty->setKierunek($this);
        }

        return $this;
    }

    public function removePrzedmioty(Przedmiot $przedmioty): self
    {
        if ($this->Przedmioty->contains($przedmioty)) {
            $this->Przedmioty->removeElement($przedmioty);
            // set the owning side to null (unless already changed)
            if ($przedmioty->getKierunek() === $this) {
                $przedmioty->setKierunek(null);
            }
        }

        return $this;
    }
}
