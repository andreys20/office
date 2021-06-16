<?php
// src/Service/ContractService.php
namespace App\Service;

use App\Entity\Contract;
use App\Entity\History;
use App\Repository\CompanyRepository;
use App\Repository\ContractRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class ContractService
{
    private $entityManager;

    public function __construct( EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    public function CreateContract($CompanyId,$UserId): int
    {
        $permitted_chars = '0123456789';
        $number = substr(str_shuffle($permitted_chars), 0, 10);
        $date = new DateTime();
        $newContract = new Contract();
        $newContract->setIdUser($UserId);
        $newContract->setIdCompany($CompanyId);
        $newContract->setNumContract($number);
        $newContract->setDateConclusion($date);
        $newContract->setStatus('active');
        $this->entityManager->persist($newContract);
        $this->entityManager->flush();

        return $newContract->getId();
    }

    public function SaveHistory($CompanyId,$UserId,$ContractId): bool
    {
        $date = new DateTime();
        $history = new History();
        $history->setIdCompany($CompanyId);
        $history->setIdUser($UserId);
        $history->setIdContract($ContractId);
        $history->setDateSigned($date);

        $this->entityManager->persist($history);
        $this->entityManager->flush();
        return true;
    }

}