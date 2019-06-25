<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="integer")
     */
    private $no_sortie;

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
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $urlPhoto;


    /**
     * @ORM\Column(type="datetime", nullable=true)
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Participants", inversedBy="sorties")
     */
    private $participantsInscrit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participants", inversedBy="sortiesOrganisees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisateur;

    public function __construct()
    {
        $this->participantsInscrit = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoSortie(): ?int
    {
        return $this->no_sortie;
    }

    public function setNoSortie(int $no_sortie): self
    {
        $this->no_sortie = $no_sortie;

        return $this;
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


    public function getUrlPhoto(): ?string
    {
        return $this->urlPhoto;
    }

    public function setUrlPhoto(?string $urlPhoto): self
    {
        $this->urlPhoto = $urlPhoto;

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

    /**
     * @return Collection|Participants[]
     */
    public function getParticipantsInscrit(): Collection
    {
        return $this->participantsInscrit;
    }

    public function addParticipantsInscrit(Participants $participantsInscrit): self
    {
        if (!$this->participantsInscrit->contains($participantsInscrit)) {
            $this->participantsInscrit[] = $participantsInscrit;
        }

        return $this;
    }

    public function removeParticipantsInscrit(Participants $participantsInscrit): self
    {
        if ($this->participantsInscrit->contains($participantsInscrit)) {
            $this->participantsInscrit->removeElement($participantsInscrit);
        }

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


}
