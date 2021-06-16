<?php

namespace App\Command;

use App\Repository\ContractRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use DateTime;

class ActiveContractCommand extends Command
{
    protected static $defaultName = 'action-contract:active';
    /**
     * @var ContractRepository
     */
    private $contractRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ContractRepository $contractRepository, EntityManagerInterface $entityManager, string $name = null)
    {
        $this->contractRepository = $contractRepository;
        $this->entityManager = $entityManager;
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $contracts = $this->contractRepository->findAll();
        foreach ($contracts as $contract){
            if ($contract->getDateEnding() === null)
            {
                continue;
            }
            if ($contract->getDateEnding() < new DateTime()){

                $contract->setStatus('inactive');
                $this->entityManager->persist($contract);
                $this->entityManager->flush();
            }
        }
        $io->success('Succses');
        return 1;
    }

    protected function configure()
    {
        $this->setDescription("Succses");
//        parent::configure(); // TODO: Change the autogenerated stub
    }
}