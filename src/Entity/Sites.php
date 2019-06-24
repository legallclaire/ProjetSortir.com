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
    private $mon_site;

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

    public function getMonSite(): ?string
    {
        return $this->mon_site;
    }

    public function setMonSite(string $mon_site): self
    {
        $this->mon_site = $mon_site;

        return $this;
    }
}
