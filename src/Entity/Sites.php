<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SitesRepository")
 */
class Sites
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
    private $no_site;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom_site;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoSite(): ?int
    {
        return $this->no_site;
    }

    public function setNoSite(int $no_site): self
    {
        $this->no_site = $no_site;

        return $this;
    }

    public function getNomSite(): ?string
    {
        return $this->nom_site;
    }

    public function setNomSite(string $nom_site): self
    {
        $this->nom_site = $nom_site;

        return $this;
    }
}
