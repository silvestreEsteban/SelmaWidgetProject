<?php

namespace App\Entity;

use App\Repository\PaymentStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentStatusRepository::class)]
class PaymentStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $payment_status = null;

    /**
     * @var Collection<int, StudentInfo>
     */
    #[ORM\OneToMany(targetEntity: StudentInfo::class, mappedBy: 'payment_status')]
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

    public function getPaymentStatus(): ?string
    {
        return $this->payment_status;
    }

    public function setPaymentStatus(string $payment_status): static
    {
        $this->payment_status = $payment_status;

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
            $studentInfo->setPaymentStatus($this);
        }

        return $this;
    }

    public function removeStudentInfo(StudentInfo $studentInfo): static
    {
        if ($this->studentInfos->removeElement($studentInfo)) {
            // set the owning side to null (unless already changed)
            if ($studentInfo->getPaymentStatus() === $this) {
                $studentInfo->setPaymentStatus(null);
            }
        }

        return $this;
    }
}
