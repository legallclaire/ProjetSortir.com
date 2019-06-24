<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtatsRepository")
 */
class Etats
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $no_etat;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $libelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoEtat(): ?int
    {
        return $this->no_etat;
    }

    public function setNoEtat(int $no_etat): self
    {
        $this->no_etat = $no_etat;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
}
