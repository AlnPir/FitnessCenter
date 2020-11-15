<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OfferRepository")
 * @UniqueEntity("title")
 */
class Offer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Subscription", mappedBy="offer")
     */
    private $subscriptions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Modality", mappedBy="offer")
     */
    private $modalities;

    public function __construct()
    {
        $this->subscriptions = new ArrayCollection();
        $this->modalities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return (new Slugify())->slugify($this->title);
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Subscription[]
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    public function addSubscription(Subscription $subscription): self
    {
        if (!$this->subscriptions->contains($subscription)) {
            $this->subscriptions[] = $subscription;
            $subscription->setOffer($this);
        }

        return $this;
    }

    public function removeSubscription(Subscription $subscription): self
    {
        if ($this->subscriptions->contains($subscription)) {
            $this->subscriptions->removeElement($subscription);
            // set the owning side to null (unless already changed)
            if ($subscription->getOffer() === $this) {
                $subscription->setOffer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Modality[]
     */
    public function getModalities(): Collection
    {
        return $this->modalities;
    }

    public function addModality(Modality $modality): self
    {
        if (!$this->modalities->contains($modality)) {
            $this->modalities[] = $modality;
            $modality->setOffer($this);
        }

        return $this;
    }

    public function removeModality(Modality $modality): self
    {
        if ($this->modalities->contains($modality)) {
            $this->modalities->removeElement($modality);
            // set the owning side to null (unless already changed)
            if ($modality->getOffer() === $this) {
                $modality->setOffer(null);
            }
        }

        return $this;
    }
}
