<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VillesRepository")
 */
class Villes
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom_ville;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $code_postal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lieux", mappedBy="ville")
     */
    private $lieux;

    public function __construct()
    {
        $this->lieux = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVille(): ?string
    {
        return $this->nom_ville;
    }

    public function setNomVille(string $nom_ville): self
    {
        $this->nom_ville = $nom_ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

//    /**
//     * @return Collection|Lieux[]
//     */
//    public function getLieux(): Collection
//    {
//        return $this->lieux;
//    }
//
//    public function addLieux(Lieux $lieux): self
//    {
//        if (!$this->lieux->contains($lieux)) {
//            $this->lieux[] = $lieux;
//            $lieux->setVilles($this);
//        }
//
//        return $this;
//    }
//
//    public function removeLieux(Lieux $lieux): self
//    {
//        if ($this->lieux->contains($lieux)) {
//            $this->lieux->removeElement($lieux);
//            // set the owning side to null (unless already changed)
//            if ($lieux->getVilles() === $this) {
//                $lieux->setVilles(null);
//            }
//        }
//
//        return $this;
//    }
}
