<?php
/**
 * Main controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainController.
 *
 * @Route("/")
 */
class MainController extends AbstractController
{
    /**
     * Index action.
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     name="main_index",
     * )
     */
    public function index(): Response
    {
        return $this->render(
            'main/index.html.twig'
        );
    }
}