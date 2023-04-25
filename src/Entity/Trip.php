<?php

namespace App\Entity;

use App\Repository\TripRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TripRepository::class)]
class Trip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startDateTime = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $limitEntryDate = null;

    #[ORM\Column]
    private ?int $maxRegistrationsNb = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $tripInfos = null;

    #[ORM\ManyToOne(inversedBy: 'organizedTrips')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $organizer = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'registeredTrips')]
    private Collection $registeredUsers;

    #[ORM\ManyToOne(inversedBy: 'trips')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Campus $campusOrganizer = null;

    #[ORM\ManyToOne(inversedBy: 'trips')]
    #[ORM\JoinColumn(nullable: false)]
    private ?State $state = null;

    #[ORM\ManyToOne(inversedBy: 'trips')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Place $place = null;

    public function __construct()
    {
        $this->registeredUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartDateTime(): ?\DateTimeInterface
    {
        return $this->startDateTime;
    }

    public function setStartDateTime(\DateTimeInterface $startDateTime): self
    {
        $this->startDateTime = $startDateTime;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getLimitEntryDate(): ?\DateTimeInterface
    {
        return $this->limitEntryDate;
    }

    public function setLimitEntryDate(\DateTimeInterface $limitEntryDate): self
    {
        $this->limitEntryDate = $limitEntryDate;

        return $this;
    }

    public function getTripInfos(): ?string
    {
        return $this->tripInfos;
    }

    public function setTripInfos(string $tripInfos): self
    {
        $this->tripInfos = $tripInfos;

        return $this;
    }

    public function getOrganizer(): ?User
    {
        return $this->organizer;
    }

    public function setOrganizer(?User $organizer): self
    {
        $this->organizer = $organizer;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getRegisteredUsers(): Collection
    {
        return $this->registeredUsers;
    }

    public function addRegisteredUser(User $registeredUser): self
    {
        if (!$this->registeredUsers->contains($registeredUser)) {
            $this->registeredUsers->add($registeredUser);
        }

        return $this;
    }

    public function removeRegisteredUser(User $registeredUser): self
    {
        $this->registeredUsers->removeElement($registeredUser);

        return $this;
    }

    public function getCampusOrganizer(): ?Campus
    {
        return $this->campusOrganizer;
    }

    public function setCampusOrganizer(?Campus $campusOrganizer): self
    {
        $this->campusOrganizer = $campusOrganizer;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getMaxRegistrationsNb(): ?int
    {
        return $this->maxRegistrationsNb;
    }

    public function setMaxRegistrationsNb(int $maxRegistrationsNb): self
    {
        $this->maxRegistrationsNb = $maxRegistrationsNb;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

        return $this;
    }

}
