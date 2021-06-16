<?php
// src/Controller/ContractController.php
namespace App\Controller;

use App\Entity\Company;
use App\Entity\Contract;
use App\Form\CreateCompany;
use App\Form\GetCompanyForm;
use App\Repository\CompanyRepository;
use App\Repository\ContractRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\ContractService;

class ContractController extends AbstractController
{
    /**
     * @Var CompanyRepository
     */
    private $companyRepository;
    private $entityManager;
    private $contractRepository;

    public function __construct(CompanyRepository $companyRepository , EntityManagerInterface $entityManager , ContractRepository $contractRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->contractRepository = $contractRepository;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/contract" , name="app_contract" , methods={"GET"})
     */
    public function ContractList(Request $request): Response
    {
        $data = $this->contractRepository->findListContract();
      //  dd($data);
        $tableColumn = [
            'id'=>[
                'label' => '№'
            ],
            'name'=>[
                'label' => 'Название'
            ],
            'email'=>[
                'label' => 'Email'
            ],
            'num_contract'=>[
                'label' => 'Номер'
            ],
            'date_conclusion'=>[
                'label' => 'Дата создания'
            ],
            'date_activation'=>[
                'label' => 'Дата активации'
            ],
            'date_ending'=>[
                'label' => 'Дата окончания'
            ],
            'sum'=>[
                'label' => 'Сумма'
            ],
            'dept'=>[
                'label' => 'Долг'
            ],
            'date_dept'=>[
                'label' => 'Дата погошения долга'
            ],
            'status'=>[
                'label' => 'Статус'
            ],
            'date_payment'=>[
                'label' => 'Дата оплаты'
            ],


        ];

        return $this->render(
            'contract/contract.html.twig', ['tableColumns' => $tableColumn]
        );
    }

    /**
     * @Route("/contract/list" , name="app_get_list_contract" , methods={"POST"})
     * @return JsonResponse
     */
    public function ActionContractData(Request $request): JsonResponse
    {

        $data = $this->contractRepository->findListContract();

        foreach ($data as $item => $value){
            $data[$item]['date_conclusion'] = (($value['date_conclusion']) ? $value['date_conclusion']->format('d.m.Y') : '-');
            $data[$item]['date_activation'] = (($value['date_activation']) ? $value['date_activation']->format('d.m.Y') : '-');
            $data[$item]['date_ending'] = (($value['date_ending']) ? $value['date_ending']->format('d.m.Y') : '-');
            $data[$item]['date_dept'] = (($value['date_dept']) ? $value['date_dept']->format('d.m.Y') : '-');
            $data[$item]['date_payment'] = (($value['date_payment']) ? $value['date_payment']->format('d.m.Y') : '-');
            $data[$item]['dept'] = (($value['dept']) ? $value['dept'] : '-');
            $data[$item]['sum'] = (($value['sum']) ? $value['sum'] : '-');
        }

        $response['data'] = $data;

        return new JsonResponse($response);
    }


    /**
     * @Route("/company", name="app_company")
     */
    public function CheckCompany(Request $request): Response
    {

        $array = $this->companyRepository->findAll();

        return $this->render(
            'contract/company.html.twig', array(
                'items' => $array,
             )
        );
    }

    /**
     * @Route("/contract/edit", name="app_contract_edit")
     */
    public function editContract(Request $request): Response
    {
        if ($request->request->get("id")){
            $data = $this->contractRepository->findOneByContract($request->request->get("id"));
        }

        $data[0]['date_conclusion'] = (($data[0]['date_conclusion'] !== null) ? $data[0]['date_conclusion']->format('Y-m-d') : '');
        $data[0]['date_activation'] = (($data[0]['date_activation'] !== null) ? $data[0]['date_activation']->format('Y-m-d') : '');
        $data[0]['date_ending'] = (($data[0]['date_ending'] !== null) ? $data[0]['date_ending']->format('Y-m-d') : '');
        $data[0]['date_dept'] = (($data[0]['date_dept'] !== null) ? $data[0]['date_dept']->format('Y-m-d') : '');
        $data[0]['date_payment'] = (($data[0]['date_payment'] !== null) ? $data[0]['date_payment']->format('Y-m-d') : '');

        return $this->render(
            'form/contract-edit.html.twig', array(
                'items' => $data[0],
            )
        );
    }

    /**
     * @Route("/contract/edit/save", name="app_contract_edit_save" , methods={"POST"})
     */
    public function editSaveContract(Request $request): JsonResponse
    {
        if ($request->request->get("id")){
            $contract = $this->contractRepository->findOneBy([
                'id' => $request->request->get("id"),
            ]);
            $contract->setDateConclusion(($request->request->get("date_conclusion"))? new DateTime($request->request->get("date_conclusion")) : null);
            $contract->setDateActivation(($request->request->get("date_activations"))? new DateTime($request->request->get("date_activations")) : null);
            $contract->setDateEnding(($request->request->get("date_ending"))? new DateTime($request->request->get("date_ending")) : null);
            $contract->setDatePayment(($request->request->get("date_payment"))? new DateTime($request->request->get("date_payment")) : null);
            $contract->setDateDept(($request->request->get("date_dept"))? new DateTime($request->request->get("date_dept")) : null);
            $contract->setSum($request->request->get("sum"));
            $contract->setDept($request->request->get("dept"));

            $this->entityManager->persist($contract);
            $this->entityManager->flush();

            return $this->json([
                'message' => 'Успешно!',
                'result' => true
            ]);
        }

        return $this->json([
            'message' => 'Ошибка при сохранении',
            'result' => false
        ]);
    }

    /**
     * @Route("/company/create" , methods={"GET" , "POST"} )
     */
    public function CreateCompany(Request $request  , ContractService $contractService): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $UserId = $this->get('security.token_storage')->getToken()->getUser();
        if ($request->request->get('type') === 'new'){
            $uniqeCompany = $this->companyRepository->findOneBy([
                'email' => $request->request->get('email')
            ]);
            if ($uniqeCompany === null){
                $permitted_chars = '0123456789';
                $license = 'license-'.substr(str_shuffle($permitted_chars), 0, 10);
                $company = new Company();
                $company->setEmail($request->request->get('email'));
                $company->setName($request->request->get('name'));
                $company->setPhone($request->request->get('phone'));
                $company->setLicense($license);
                $this->entityManager->persist($company);
                $this->entityManager->flush();
                $id = $company->getId();
                $idContract = $contractService->CreateContract($id,$UserId->getId());
                $setHistory = $contractService->SaveHistory($id,$UserId->getId(),$idContract);

                return $this->json([
                    'message' => 'Контракт успешно созданы',
                    'result' => true
                ]);
            }
            else{
                return $this->json([
                    'message' => 'Компания есть в базе',
                    'result' => false
                ]);
            }
        }
        else if ($request->request->get('type') === 'old'){
            $setContract = $contractService->CreateContract($request->request->get('id'),$UserId->getId());
            $setHistory = $contractService->SaveHistory($request->request->get('id'),$UserId->getId(),$setContract);
            return $this->json([
                'message' => 'Контракт успешно созданы',
                'result' => true
            ]);
        }
    }
}