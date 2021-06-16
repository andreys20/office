<?php
// src/Form/GetCompanyForm.php
namespace App\Form;

use App\Entity\User;
use App\Entity\Company;
use App\Repository\CompanyRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Doctrine\ORM\EntityManagerInterface;

class GetCompanyForm extends AbstractType
{
    /**
     * @Var CompanyRepository
     */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $company = $this->companyRepository->findAllCompany();
        $companyChoices = array();

        foreach($company as $value) {
            $companyChoices[$value['name']] = $value['id'];
        }
//        var_dump($company);
        $builder
            ->add('company', ChoiceType::class, array(
                'choices' => $companyChoices
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Company::class,
        ));
    }
}