<?php

namespace App\Entity;

use App\Repository\ContractRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContractRepository::class)
 */
class Contract
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $num_contract;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_company;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_conclusion;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_activation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_ending;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sum;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dept;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_dept;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dock;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_payment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getNumContract(): ?string
    {
        return $this->num_contract;
    }

    public function setNumContract(string $num_contract): self
    {
        $this->num_contract = $num_contract;

        return $this;
    }

    public function getIdCompany(): ?int
    {
        return $this->id_company;
    }

    public function setIdCompany(int $id_company): self
    {
        $this->id_company = $id_company;

        return $this;
    }

    public function getDateConclusion(): ?\DateTimeInterface
    {
        return $this->date_conclusion;
    }

    public function setDateConclusion(?\DateTimeInterface $date_conclusion): self
    {
        $this->date_conclusion = $date_conclusion;

        return $this;
    }

    public function getDateActivation(): ?\DateTimeInterface
    {
        return $this->date_activation;
    }

    public function setDateActivation(?\DateTimeInterface $date_activation): self
    {
        $this->date_activation = $date_activation;

        return $this;
    }

    public function getDateEnding(): ?\DateTimeInterface
    {
        return $this->date_ending;
    }

    public function setDateEnding(?\DateTimeInterface $date_ending): self
    {
        $this->date_ending = $date_ending;

        return $this;
    }

    public function getSum(): ?int
    {
        return $this->sum;
    }

    public function setSum(?int $sum): self
    {
        $this->sum = $sum;

        return $this;
    }

    public function getDept(): ?int
    {
        return $this->dept;
    }

    public function setDept(?int $dept): self
    {
        $this->dept = $dept;

        return $this;
    }

    public function getDateDept(): ?\DateTimeInterface
    {
        return $this->date_dept;
    }

    public function setDateDept(?\DateTimeInterface $date_dept): self
    {
        $this->date_dept = $date_dept;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDock(): ?string
    {
        return $this->dock;
    }

    public function setDock(?string $dock): self
    {
        $this->dock = $dock;

        return $this;
    }

    public function getDatePayment(): ?\DateTimeInterface
    {
        return $this->date_payment;
    }

    public function setDatePayment(?\DateTimeInterface $date_payment): self
    {
        $this->date_payment = $date_payment;

        return $this;
    }
}
