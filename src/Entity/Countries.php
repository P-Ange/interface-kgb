<?php

namespace App\Entity;

use App\Repository\CountriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountriesRepository::class)]
class Countries
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 60)]
    private $country;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: HidingPlaces::class)]
    private $hidingPlaces;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Agents::class)]
    private $agents;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Targets::class)]
    private $targets;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Contacts::class)]
    private $contacts;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Missions::class)]
    private $missions;

    public function __construct()
    {
        $this->hidingPlaces = new ArrayCollection();
        $this->agents = new ArrayCollection();
        $this->targets = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|HidingPlaces[]
     */
    public function getHidingPlaces(): Collection
    {
        return $this->hidingPlaces;
    }

    public function addHidingPlace(HidingPlaces $hidingPlace): self
    {
        if (!$this->hidingPlaces->contains($hidingPlace)) {
            $this->hidingPlaces[] = $hidingPlace;
            $hidingPlace->setCountry($this);
        }

        return $this;
    }

    public function removeHidingPlace(HidingPlaces $hidingPlace): self
    {
        if ($this->hidingPlaces->removeElement($hidingPlace)) {
            // set the owning side to null (unless already changed)
            if ($hidingPlace->getCountry() === $this) {
                $hidingPlace->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Agents[]
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agents $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
            $agent->setCountry($this);
        }

        return $this;
    }

    public function removeAgent(Agents $agent): self
    {
        if ($this->agents->removeElement($agent)) {
            // set the owning side to null (unless already changed)
            if ($agent->getCountry() === $this) {
                $agent->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Targets[]
     */
    public function getTargets(): Collection
    {
        return $this->targets;
    }

    public function addTarget(Targets $target): self
    {
        if (!$this->targets->contains($target)) {
            $this->targets[] = $target;
            $target->setCountry($this);
        }

        return $this;
    }

    public function removeTarget(Targets $target): self
    {
        if ($this->targets->removeElement($target)) {
            // set the owning side to null (unless already changed)
            if ($target->getCountry() === $this) {
                $target->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contacts[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contacts $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setCountry($this);
        }

        return $this;
    }

    public function removeContact(Contacts $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getCountry() === $this) {
                $contact->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Missions[]
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Missions $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->setCountry($this);
        }

        return $this;
    }

    public function removeMission(Missions $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getCountry() === $this) {
                $mission->setCountry(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return (string) $this->getCountry();
    }
}
