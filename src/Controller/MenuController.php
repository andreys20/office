<?php
// src/Controller/MenuController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class MenuController extends AbstractController
{
    /**
     * @Route("/menu")
     */
    public function menuAction(): Response
    {
        $page = [
            [
                'documents' => [
                    'title' => 'Работа с договорами',
                    'description' => '<p>Заведение договоров в информационную базу.</p>
                                  <p>Редактирование позиций договора.</p>',
                    'data' => [
                        [
                            'text' => 'Создать',
                            'link' => 'app_company'
                        ],
                        [
                            'text' => 'Список',
                            'link' => 'app_contract'
                        ],
                    ],
                    'img' => '/img/documents.jpg'
                ]
            ],
            [
                'documents' => [
                    'title' => 'Отчет',
                    'description' => '<p>Получение статистики заключения договоров.</p>
                                  <p>Получение статистики активности сотрудников.</p>',
                    'data' => [
                        [
                            'text' => 'Статистика',
                            'link' => 'app_statistic'
                        ],
                        [
                            'text' => 'Активность',
                            'link' => 'app_menu_page'
                        ],
                    ],
                    'img' => '/img/statistic.jpg'
                ]
            ],
            [
                'documents' => [
                    'title' => 'Информация',
                    'description' => '<p>Список контактов.</p>
                                  <p>Руководство использования.</p>',
                    'data' => [
                        [
                            'text' => 'Контакты',
                            'link' => 'app_contacts'
                        ],
                        [
                            'text' => 'Помощь',
                            'link' => 'app_help'
                        ],
                    ],
                    'img' => '/img/info.jpg!d'
                ]
            ],
        ];
        return $this->render('/home.html.twig', [
            'menu' => $page,
        ]);
    }
}