<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoryRepository::class)
 */
class History
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
    private $id_contract;

    /**
     * @ORM\Column(type="date")
     */
    private $date_signed;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_company;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdContract(): ?int
    {
        return $this->id_contract;
    }

    public function setIdContract(int $id_contract): self
    {
        $this->id_contract = $id_contract;

        return $this;
    }

    public function getDateSigned(): ?\DateTimeInterface
    {
        return $this->date_signed;
    }

    public function setDateSigned(\DateTimeInterface $date_signed): self
    {
        $this->date_signed = $date_signed;

        return $this;
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

    public function getIdCompany(): ?int
    {
        return $this->id_company;
    }

    public function setIdCompany(int $id_company): self
    {
        $this->id_company = $id_company;

        return $this;
    }
}
