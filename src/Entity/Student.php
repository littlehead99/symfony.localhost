<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=4)
     */
    private $rok_urodzenia;

    /**
     * @ORM\ManyToMany(targetEntity=Przedmiot::class, inversedBy="Studenci")
     */
    private $przedmioty;

    /**
     * @ORM\ManyToOne(targetEntity=Kierunek::class, inversedBy="Studenci")
     */
    private $kierunek;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nazwisko;


    public function __construct()
    {
        $this->przedmioty = new ArrayCollection();
        $this->przedmioty = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->imie.' '.$this->nazwisko.' '.$this->rok_urodzenia;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImie(): ?string
    {
        return $this->imie;
    }

    public function setImie(string $imie): self
    {
        $this->imie = $imie;

        return $this;
    }

    public function getNazwisko(): ?string
    {
        return $this->nazwisko;
    }

    public function setNazwisko(string $nazwisko): self
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    public function getRokUrodzenia(): ?string
    {
        return $this->rok_urodzenia;
    }

    public function setRokUrodzenia(string $rok_urodzenia): self
    {
        $this->rok_urodzenia = $rok_urodzenia;

        return $this;
    }

    /**
     * @return Collection|Przedmiot[]
     */
    public function getPrzedmioty(): Collection
    {
        return $this->przedmioty;
    }

    public function addPrzedmioty(Przedmiot $przedmioty): self
    {
        if (!$this->przedmioty->contains($przedmioty)) {
            $this->przedmioty[] = $przedmioty;
        }

        return $this;
    }

    public function removePrzedmioty(Przedmiot $przedmioty): self
    {
        if ($this->przedmioty->contains($przedmioty)) {
            $this->przedmioty->removeElement($przedmioty);
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
