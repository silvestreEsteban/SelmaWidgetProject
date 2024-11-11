<?php

namespace App\Entity;

use App\Repository\StudentInfoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentInfoRepository::class)]
class StudentInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $phone_number = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_of_birth = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $preferred_name = null;

    #[ORM\ManyToOne(inversedBy: 'studentInfos')]
    private ?LearningStyle $learning_style = null;

    #[ORM\ManyToOne(inversedBy: 'studentInfos')]
    private ?Neurodiversity $neurodiversity = null;

    #[ORM\ManyToOne(inversedBy: 'studentInfos')]
    private ?Gender $gender = null;

    #[ORM\Column(length: 255)]
    private ?string $ethnicity = null;

    #[ORM\Column]
    private ?bool $nz_citizen = null;

    #[ORM\ManyToOne(inversedBy: 'studentInfos')]
    private ?PaymentStatus $payment_status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(int $phone_number): static
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(\DateTimeInterface $date_of_birth): static
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    public function getPreferredName(): ?string
    {
        return $this->preferred_name;
    }

    public function setPreferredName(?string $preferred_name): static
    {
        $this->preferred_name = $preferred_name;

        return $this;
    }

    public function getLearningStyle(): ?LearningStyle
    {
        return $this->learning_style;
    }

    public function setLearningStyle(?LearningStyle $learning_style): static
    {
        $this->learning_style = $learning_style;

        return $this;
    }

    public function getNeurodiversity(): ?Neurodiversity
    {
        return $this->neurodiversity;
    }

    public function setNeurodiversity(?Neurodiversity $neurodiversity): static
    {
        $this->neurodiversity = $neurodiversity;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getEthnicity(): ?string
    {
        return $this->ethnicity;
    }

    public function setEthnicity(string $ethnicity): static
    {
        $this->ethnicity = $ethnicity;

        return $this;
    }

    public function isNzCitizen(): ?bool
    {
        return $this->nz_citizen;
    }

    public function setNzCitizen(bool $nz_citizen): static
    {
        $this->nz_citizen = $nz_citizen;

        return $this;
    }

    public function getPaymentStatus(): ?PaymentStatus
    {
        return $this->payment_status;
    }

    public function setPaymentStatus(?PaymentStatus $payment_status): static
    {
        $this->payment_status = $payment_status;

        return $this;
    }
}
