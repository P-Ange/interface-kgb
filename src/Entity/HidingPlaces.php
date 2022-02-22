<?php

namespace App\Entity;

use App\Repository\HidingPlacesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Validator\Collections;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: HidingPlacesRepository::class)]
#[UniqueEntity(fields: 'alias')]
class HidingPlaces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 40)]
    #[Assert\NotBlank]
    #[Assert\Type("string")]
    private $alias;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type("string")]
    private $address;

    #[ORM\Column(type: 'string', length: 60)]
    #[Assert\NotBlank]
    private $type;

    #[ORM\ManyToOne(targetEntity: Countries::class, inversedBy: 'HidingPlaces')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private $country;

    #[ORM\ManyToMany(targetEntity: Missions::class, inversedBy: 'HidingPlaces')]
    private $missions;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCountry(): ?Countries
    {
        return $this->country;
    }

    public function setCountry(?Countries $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|missions[]
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(missions $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
        }

        return $this;
    }

    public function removeMission(missions $mission): self
    {
        $this->missions->removeElement($mission);

        return $this;
    }
}
