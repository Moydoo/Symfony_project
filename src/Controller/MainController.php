<?php
/**
 * Event controller.
 */

namespace App\Controller;

use App\Entity\Event;
use App\Repository\MainRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EventController.
 *
 * @Route("/")
 */
class MainController extends AbstractController
{
    /**
     * Index action.
     *
     * @param Request            $request         HTTP request
     * @param MainRepository     $eventRepository Event repository
     * @param PaginatorInterface $paginator       Paginator
     *
     * @return Response HTTP response
     *
     * @Route(
     *     "/",
     *     methods={"GET"},
     *     name="main_index",
     * )
     */
    public function index(Request $request, MainRepository $eventRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $eventRepository->queryAll(),
            $request->query->getInt('page', 1),
            MainRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render(
            'main/index.html.twig',
            [
                'pagination' => $pagination,
            ]
        );
    }

    /**
     * Show action.
     *
     * @param Event $event Event entity
     *
     * @return Response HTTP response
     *
     * @Route(
     *     "/{id}",
     *     methods={"GET"},
     *     name="event_show",
     *     requirements={"id": "[1-9]\d*"},
     * )
     */
    public function show(Event $event): Response
    {
        return $this->render(
            'event/show.html.twig',
            ['event' => $event]
        );
    }
}
