<?php
// src/Controller/HelpController.php
namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HelpController extends AbstractController
{
    /**
     * @Route("/help", name="app_help")
     */
    public function registerAction(Request $request)
    {

        return $this->render(
            'help/help.html.twig'
        );
    }
}
