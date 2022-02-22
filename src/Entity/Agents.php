<?php

namespace App\Entity;

use App\Repository\AgentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Validator\Collections;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AgentsRepository::class)]
#[UniqueEntity(fields: 'lastname')]
#[UniqueEntity(fields: 'id_code')]
class Agents
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 60)]
    #[Assert\NotBlank]
    #[Assert\Type("string")]
    private $firstname;

    #[ORM\Column(type: 'string', length: 60)]
    #[Assert\NotBlank]
    #[Assert\Type("string")]
    private $lastname;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private $date_of_bith;

    #[ORM\Column(type: 'string', length: 40)]
    #[Assert\NotBlank]
    #[Assert\Type("string")]
    private $id_code;

    #[ORM\ManyToOne(targetEntity: Countries::class, inversedBy: 'agents')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private $country;

    #[ORM\ManyToMany(targetEntity: Skills::class, inversedBy: 'agents')]
    #[Assert\NotBlank]
    #[Collections]
    private $skills;

    #[ORM\ManyToMany(targetEntity: Missions::class, inversedBy: 'agents')]

    private $missions;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getDateOfBith(): ?\DateTimeInterface
    {
        return $this->date_of_bith;
    }

    public function setDateOfBith(\DateTimeInterface $date_of_bith): self
    {
        $this->date_of_bith = $date_of_bith;

        return $this;
    }

    public function getIdCode(): ?string
    {
        return $this->id_code;
    }

    public function setIdCode(string $id_code): self
    {
        $this->id_code = $id_code;

        return $this;
    }

    public function getCountry(): ?countries
    {
        return $this->country;
    }

    public function setCountry(?countries $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|skills[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(skills $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
        }

        return $this;
    }

    public function removeSkill(skills $skill): self
    {
        $this->skills->removeElement($skill);

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
    public function displaySkills()
    {
        $agentsSkills = $this->skills;
        $skillsList = [];

        foreach ($agentsSkills as $skills) {
            $skillsList[] = $skills->getSkill();
        }
        return $skillsList;
    }



}
