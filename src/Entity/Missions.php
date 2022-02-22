<?php

namespace App\Entity;

use App\Repository\MissionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Validator\Collections;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MissionsRepository::class)]
#[UniqueEntity(fields: 'title')]
#[UniqueEntity(fields: 'codename')]
class Missions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank]
    #[Assert\Type("string")]
    private $title;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    #[Assert\Type("string")]
    private $description;

    #[ORM\Column(type: 'string', length: 40)]
    #[Assert\NotBlank]
    #[Assert\Type("string")]
    private $codename;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
       private $start_date;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private $end_date;

    #[ORM\ManyToOne(targetEntity: Skills::class, inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private $skill;

    #[ORM\ManyToOne(targetEntity: MissionTypes::class, inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private $mission_type;

    #[ORM\ManyToOne(targetEntity: StatusMissions::class, inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private $status_mission;

    #[ORM\ManyToOne(targetEntity: Countries::class, inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private $country;

    #[ORM\ManyToMany(targetEntity: Agents::class, inversedBy: 'missions')]
    #[Assert\NotBlank]
    #[Collections]
    private $agents;

    #[ORM\ManyToMany(targetEntity: Targets::class, inversedBy: 'missions')]
    #[Assert\NotBlank]
    #[Collections]
    private $targets;

    #[ORM\ManyToMany(targetEntity: Contacts::class, inversedBy: 'missions')]
    #[Assert\NotBlank]
    #[Collections]
    private $contacts;

    #[ORM\ManyToMany(targetEntity: HidingPlaces::class, inversedBy: 'missions')]

    private $hidingplaces;

    public function __construct()
    {
        $this->agents = new ArrayCollection();
        $this->targets = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->hidingplaces = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCodename(): ?string
    {
        return $this->codename;
    }

    public function setCodename(string $codename): self
    {
        $this->codename = $codename;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getSkill(): ?skills
    {
        return $this->skill;
    }

    public function setSkill(?skills $skill): self
    {
        $this->skill = $skill;

        return $this;
    }

    public function getMissionType(): ?missiontypes
    {
        return $this->mission_type;
    }

    public function setMissionType(?missiontypes $mission_type): self
    {
        $this->mission_type = $mission_type;

        return $this;
    }

    public function getStatusMission(): ?statusmissions
    {
        return $this->status_mission;
    }

    public function setStatusMission(?statusmissions $status_mission): self
    {
        $this->status_mission = $status_mission;

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
            $agent->addMission($this);
        }

        return $this;
    }

    public function removeAgent(Agents $agent): self
    {
        if ($this->agents->removeElement($agent)) {
            $agent->removeMission($this);
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
            $target->addMission($this);
        }

        return $this;
    }

    public function removeTarget(Targets $target): self
    {
        if ($this->targets->removeElement($target)) {
            $target->removeMission($this);
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
            $contact->addMission($this);
        }

        return $this;
    }

    public function removeContact(Contacts $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            $contact->removeMission($this);
        }

        return $this;
    }

    /**
     * @return Collection|HidingPlaces[]
     */
    public function getHidingplaces(): Collection
    {
        return $this->hidingplaces;
    }

    public function addHidingplace(Hidingplaces $hidingplace): self
    {
        if (!$this->hidingplaces->contains($hidingplace)) {
            $this->hidingplaces[] = $hidingplace;
            $hidingplace->addMission($this);
        }

        return $this;
    }

    public function removeHidingplace(Hidingplaces $hidingplace): self
    {
        if ($this->hidingplaces->removeElement($hidingplace)) {
            $hidingplace->removeMission($this);
        }

        return $this;
    }

    public function contactsAreValid(): bool
    {
        $dataCountry = $this->country;
        $dataContacts = $this->contacts;

        foreach ($dataContacts as $contact) {
            if ($dataCountry != $contact->getCountry()) {
                return false;
            }
        }
        return true;
    }

    public function hidingplacesIsValid(): bool
    {
        $dataCountry = $this->country;
        $dataHidingplaces = $this->hidingplaces;

        foreach ($dataHidingplaces as $hidingplaces) {
            if ($hidingplaces->getCountry() != $dataCountry) {
                return false;
            }
        }
        return true;
    }

    public function agentsSkillsAreValid(): bool
    {
        $dataSkills = $this->skill;
        $dataAgents = $this->agents;

        $validSkillsAgents = 0;

        foreach ($dataAgents as $agent) {
            $agentSkills = $agent->displaySkills();
            if (in_array($dataSkills->getSkill(), $agentSkills)) {
                $validSkillsAgents += 1;
            }
            if ($validSkillsAgents == 0) {
                return false;
            }
        }
        return true;
    }

    public function agentsCountryAreValid(): bool
    {
        $dataAgents = $this->agents;
        $dataTargets = $this->targets;

        foreach ($dataAgents as $agent) {
            foreach ($dataTargets as $target) {
                if ($agent->getCountry() == $target->getCountry()) {
                    return false;
                }
            }
        }
        return true;
    }

    public function missionIsValid(): bool
    {

        if (!$this->contactsAreValid() || !$this->hidingplacesIsValid() || !$this->agentsSkillsAreValid() || !$this->agentsCountryAreValid()) {
            return false;
        }
        return true;
    }

}


