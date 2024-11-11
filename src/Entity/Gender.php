<?php

namespace App\Entity;

use App\Repository\GenderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenderRepository::class)]
class Gender
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $gender = null;

    /**
     * @var Collection<int, StudentInfo>
     */
    #[ORM\OneToMany(targetEntity: StudentInfo::class, mappedBy: 'gender')]
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

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

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
            $studentInfo->setGender($this);
        }

        return $this;
    }

    public function removeStudentInfo(StudentInfo $studentInfo): static
    {
        if ($this->studentInfos->removeElement($studentInfo)) {
            // set the owning side to null (unless already changed)
            if ($studentInfo->getGender() === $this) {
                $studentInfo->setGender(null);
            }
        }

        return $this;
    }
}
