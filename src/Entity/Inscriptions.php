<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionsRepository")
 */
class Inscriptions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_inscription;

    /**
     * @ORM\Column(type="integer")
     */
    private $sorties_no_sortie;

    /**
     * @ORM\Column(type="integer")
     */
    private $participants_no_participants;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): self
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    public function getSortiesNoSortie(): ?int
    {
        return $this->sorties_no_sortie;
    }

    public function setSortiesNoSortie(int $sorties_no_sortie): self
    {
        $this->sorties_no_sortie = $sorties_no_sortie;

        return $this;
    }

    public function getParticipantsNoParticipants(): ?int
    {
        return $this->participants_no_participants;
    }

    public function setParticipantsNoParticipants(int $participants_no_participants): self
    {
        $this->participants_no_participants = $participants_no_participants;

        return $this;
    }
}
