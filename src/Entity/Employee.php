<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: User::class, inversedBy: 'employee')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $email = null;

    #[Assert\Valid]
    #[ORM\OneToMany(targetEntity: EmployeeContract::class, mappedBy: 'employee', cascade: ['all'], orphanRemoval: true)]
    private Collection $contracts;

    #[Assert\Valid]
    #[ORM\OneToMany(mappedBy: 'employee', targetEntity: EmployeeVacation::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $vacations;

    public function __construct()
    {
        $this->contracts = new ArrayCollection();
        $this->vacations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return Collection<int, EmployeeContract>
     */
    public function getContracts(): Collection
    {
        return $this->contracts;
    }

    public function getContractsCount(): int
    {
        return $this->contracts->count();
    }

    public function addContract(EmployeeContract $contract): self
    {
        if (!$this->contracts->contains($contract)) {
            $this->contracts[] = $contract;
            $contract->setEmployee($this);
        }
        return $this;
    }

    public function removeContract(EmployeeContract $contract): self
    {
        if ($this->contracts->removeElement($contract)) {
            if ($contract->getEmployee() === $this) {
                $contract->setEmployee(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, EmployeeVacation>
     */
    public function getVacations(): Collection
    {
        return $this->vacations;
    }

    public function addVacation(EmployeeVacation $vacation): self
    {
        if (!$this->vacations->contains($vacation)) {
            $this->vacations[] = $vacation;
            $vacation->setEmployee($this);
        }

        return $this;
    }

    public function removeVacation(EmployeeVacation $vacation): self
    {
        if ($this->vacations->removeElement($vacation)) {
            if ($vacation->getEmployee() === $this) {
                $vacation->setEmployee(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }
}
