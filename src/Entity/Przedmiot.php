<?php

namespace App\Entity;

use App\Repository\PrzedmiotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrzedmiotRepository::class)
 */
class Przedmiot
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prowadzacy;

    /**
     * @ORM\ManyToMany(targetEntity=Student::class, mappedBy="Przedmioty")
     */
    private $Studenci;

    /**
     * @ORM\ManyToOne(targetEntity=Kierunek::class, inversedBy="Przedmioty")
     */
    private $kierunek;

    public function __construct()
    {
        $this->Studenci = new ArrayCollection();
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

    public function getProwadzacy(): ?string
    {
        return $this->prowadzacy;
    }

    public function setProwadzacy(?string $prowadzacy): self
    {
        $this->prowadzacy = $prowadzacy;

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
            $studenci->addPrzedmioty($this);
        }

        return $this;
    }

    public function removeStudenci(Student $studenci): self
    {
        if ($this->Studenci->contains($studenci)) {
            $this->Studenci->removeElement($studenci);
            $studenci->removePrzedmioty($this);
        }

        return $this;
    }

    public function getKierunek(): ?Kierunek
    {
        return $this->kierunek;
    }

    public function setKierunek(?Kierunek $kierunek): self
    {
        $this->kierunek = $kierunek;

        return $this;
    }

}
