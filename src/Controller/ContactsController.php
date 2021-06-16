<?php
// src/Controller/ContactsController.php
namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactsController extends AbstractController
{

    /**
     * @Route("/contacts" , name="app_contacts")
     */
    public function ContactsPage(Request $request): Response
    {
        $data['email'] = 'help.infooffice@mail.ru';
        $data['social'] = [
            [
                'img' => '/img/whatsapp.svg',
                'name' => "WhatsApp",
                'link' => 'https://wa.me/89020927971',
                'text' => '@infoofficewa'
            ],
            [
                'img' => '/img/telegram.svg',
                'name' => 'Telegram',
                'link' => 'https://t.me/joinchat/DpmhSPvaSCU2M2Ni',
                'text' => '@infoofficetg'
            ],
        ];

        return $this->render(
            'contacts/contacts.html.twig', array(
              'data' => $data
        )
        );
    }

}