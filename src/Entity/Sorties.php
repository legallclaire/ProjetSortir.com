<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SortiesRepository")
 */
class Sorties
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
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datedebut;


    /**
     * @ORM\Column(type="datetime")
     * @Assert\Expression("value<=this.getDatedebut()")
     */
    private $dateclosure;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbinscriptionsmax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptioninfos;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Expression("value>=this.getDatedebut()")
     */
    private $datefin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieux")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lieu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participants", inversedBy="sortiesOrganisees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisateur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Participants", inversedBy="sortiesPrevues")
     */
    private $participants;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $IsPublished;


    public function __construct()
    {
        $this->participantsInscrit = new ArrayCollection();
        $this->participants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDateclosure(): ?\DateTimeInterface
    {
        return $this->dateclosure;
    }

    public function setDateclosure(\DateTimeInterface $dateclosure): self
    {
        $this->dateclosure = $dateclosure;

        return $this;
    }

    public function getNbinscriptionsmax(): ?int
    {
        return $this->nbinscriptionsmax;
    }

    public function setNbinscriptionsmax(int $nbinscriptionsmax): self
    {
        $this->nbinscriptionsmax = $nbinscriptionsmax;

        return $this;
    }

    public function getDescriptioninfos(): ?string
    {
        return $this->descriptioninfos;
    }

    public function setDescriptioninfos(?string $descriptioninfos): self
    {
        $this->descriptioninfos = $descriptioninfos;

        return $this;
    }


    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(?\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getLieu(): ?Lieux
    {
        return $this->lieu;
    }

    public function setLieu(?Lieux $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getEtat(): ?Etats
    {
        return $this->etat;
    }

    public function setEtat(?Etats $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getSite(): ?Sites
    {
        return $this->site;
    }

    public function setSite(?Sites $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getOrganisateur(): ?Participants
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?Participants $organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    /**
     * @return Collection|Participants[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participants $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(Participants $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
        }

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->IsPublished;
    }

    public function setIsPublished(?bool $IsPublished): self
    {
        $this->IsPublished = $IsPublished;

        return $this;
    }

}
