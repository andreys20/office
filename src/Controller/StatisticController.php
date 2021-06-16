<?php
// src/Controller/StatisticController.php
namespace App\Controller;

use App\Entity\User;
use App\Repository\CompanyRepository;
use App\Repository\ContractRepository;
use App\Repository\HistoryRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class StatisticController extends AbstractController
{

    /**
     * @Var CompanyRepository
     */

    private $entityManager;
    private $contractRepository;
    private $historyRepository;

    public function __construct(HistoryRepository $historyRepository , EntityManagerInterface $entityManager , ContractRepository $contractRepository)
    {
        $this->contractRepository = $contractRepository;
        $this->entityManager = $entityManager;
        $this->historyRepository = $historyRepository;
    }

    /**
     * @Route("/statistic", name="app_statistic")
     */
    public function statisticAction(Request $request): Response
    {
        return $this->render(
            'statistic/history.html.twig'
        );
    }

    /**
     * @Route("/statisticUser",methods={"POST"})
     * @return JsonResponse
     */
    public function statisticDataUser(Request $request): JsonResponse
    {
        $userId = $this->get('security.token_storage')->getToken()->getUser();
        $data = $this->historyRepository->findBy([
           'id_user' => $userId->getId(),
        ]);
        $response = [];
        $filterDate = new DateTime();
        foreach ($data as $item){
            if ($filterDate->format('m.Y') === $item->getDateSigned()->format('m.Y')){
                $arrayMoth[$item->getDateSigned()->format('j')][] = $item->getIdContract();
            }
            if ($filterDate->format('Y') === $item->getDateSigned()->format('Y')){
                $arrayYear[$item->getDateSigned()->format('m')][] = $item->getIdContract();
            }
        }
       ksort($arrayMoth);
       ksort($arrayYear);
        foreach ($arrayMoth as $index => $item){
            $response['moth']['scale'][] = $index;
            $response['moth']['series'][] = count($item);
        }
        foreach ($arrayYear as $index => $item){
            $response['year']['scale'][] = $index;
            $response['year']['series'][] = count($item);
        }

        return new JsonResponse($response);
    }
}
