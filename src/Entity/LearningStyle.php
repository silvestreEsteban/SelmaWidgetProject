<?php

namespace App\Entity;

use App\Repository\LearningStyleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LearningStyleRepository::class)]
class LearningStyle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $learning_style = null;

    /**
     * @var Collection<int, StudentInfo>
     */
    #[ORM\OneToMany(targetEntity: StudentInfo::class, mappedBy: 'learning_style')]
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

    public function getLearningStyle(): ?string
    {
        return $this->learning_style;
    }

    public function setLearningStyle(?string $learning_style): static
    {
        $this->learning_style = $learning_style;

        return $this;
    }

    public function __toString(): string
    {
        return $this->learning_style ?? '';
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
            $studentInfo->setLearningStyle($this);
        }

        return $this;
    }

    public function removeStudentInfo(StudentInfo $studentInfo): static
    {
        if ($this->studentInfos->removeElement($studentInfo)) {
            // set the owning side to null (unless already changed)
            if ($studentInfo->getLearningStyle() === $this) {
                $studentInfo->setLearningStyle(null);
            }
        }

        return $this;
    }
}
