<?php

namespace App\Entity;

use App\Repository\NeurodiversityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NeurodiversityRepository::class)]
class Neurodiversity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $neurodiversity = null;

    /**
     * @var Collection<int, StudentInfo>
     */
    #[ORM\OneToMany(targetEntity: StudentInfo::class, mappedBy: 'neurodiversity')]
    private Collection $studentInfos;

    public function __construct()
    {
        $this->studentInfos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNeurodiversity(): ?string
    {
        return $this->neurodiversity;
    }

    public function setNeurodiversity(?string $neurodiversity): static
    {
        $this->neurodiversity = $neurodiversity;

        return $this;
    }

    /**
     * @return Collection<int, StudentInfo>
     */
    public function getStudentInfos(): Collection
    {
        return $this->studentInfos;
    }

    public function addStudentInfo(StudentInfo $studentInfo): static
    {
        if (!$this->studentInfos->contains($studentInfo)) {
            $this->studentInfos->add($studentInfo);
            $studentInfo->setNeurodiversity($this);
        }

        return $this;
    }

    public function removeStudentInfo(StudentInfo $studentInfo): static
    {
        if ($this->studentInfos->removeElement($studentInfo)) {
            // set the owning side to null (unless already changed)
            if ($studentInfo->getNeurodiversity() === $this) {
                $studentInfo->setNeurodiversity(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->neurodiversity ?? '';
    }
}
