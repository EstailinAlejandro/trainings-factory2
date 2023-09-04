<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonRepository::class)]
class Lesson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    public ?\DateTimeInterface $time = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    public ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    public ?string $locaion = null;

    #[ORM\ManyToOne(inversedBy: 'lesson')]
    public ?Person $person = null;

    #[ORM\ManyToOne(inversedBy: 'lesson')]
    public ?Training $training = null;

    #[ORM\OneToMany(mappedBy: 'lesson', targetEntity: Registration::class)]
    public Collection $registration;

    public function __construct()
    {
        $this->registration = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLocaion(): ?string
    {
        return $this->locaion;
    }

    public function setLocaion(string $locaion): self
    {
        $this->locaion = $locaion;

        return $this;
    }


    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getTraining(): ?Training
    {
        return $this->training;
    }

    public function setTraining(?Training $training): self
    {
        $this->training = $training;

        return $this;
    }

    /**
     * @return Collection<int, Registration>
     */
    public function getRegistration(): Collection
    {
        return $this->registration;
    }

    public function addRegistration(Registration $registration): self
    {
        if (!$this->registration->contains($registration)) {
            $this->registration->add($registration);
            $registration->setLesson($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): self
    {
        if ($this->registration->removeElement($registration)) {
            // set the owning side to null (unless already changed)
            if ($registration->getLesson() === $this) {
                $registration->setLesson(null);
            }
        }

        return $this;
    }

}
