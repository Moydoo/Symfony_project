<?php
/**
 * Contact controller.
 */

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContactController.
 *
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
    /**
     * Index action.
     *
     * @param Request            $request           HTTP request
     * @param ContactRepository  $contactRepository Contact repository
     * @param PaginatorInterface $paginator         Paginator
     *
     * @return Response HTTP response
     *
     * @Route(
     *     "/",
     *     name="contact_index",
     * )
     */
    public function index(Request $request, ContactRepository $contactRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $contactRepository->queryAll(),
            $request->query->getInt('page', 1),
            ContactRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render(
            'contact/index.html.twig',
            ['pagination' => $pagination]
        );
    }

    /**
     * Show action.
     *
     * @param Contact $contact Contact entity
     *
     * @return Response HTTP response
     *
     * @Route(
     *     "/{id}",
     *     methods={"GET"},
     *     name="contact_show",
     *     requirements={"id": "[1-9]\d*"},
     * )
     */
    public function show(Contact $contact): Response
    {
        return $this->render(
            'contact/show.html.twig',
            ['contact' => $contact]
        );
    }

    /**
     * Create action.
     *
     * @param Request           $request           HTTP request
     * @param ContactRepository $contactrepository Contact repository
     *
     * @return Response HTTP response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @Route(
     *     "/create",
     *     methods={"GET", "POST"},
     *     name="contact_create",
     * )
     */
    public function create(Request $request, ContactRepository $contactrepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactrepository->save($contact);

            $this->addFlash('success', 'message_created_successfully');

            return $this->redirectToRoute('contact_index');
        }

        return $this->render(
            'contact/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param Request           $request           HTTP request
     * @param Contact           $contact           Contact entity
     * @param ContactRepository $contactRepository Contact repository
     *
     * @return Response HTTP response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @Route(
     *     "/{id}/edit",
     *     methods={"GET", "PUT"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="contact_edit",
     * )
     */
    public function edit(Request $request, Contact $contact, ContactRepository $contactRepository): Response
    {
        $form = $this->createForm(ContactType::class, $contact, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactRepository->save($contact);

            $this->addFlash('success', 'message_updated_successfully');

            return $this->redirectToRoute('contact_index');
        }

        return $this->render(
            'contact/edit.html.twig',
            [
                'form' => $form->createView(),
                'contact' => $contact,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param Request           $request           HTTP request
     * @param Contact           $contact           Category entity
     * @param ContactRepository $contactRepository Category repository
     *
     * @return Response HTTP response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @Route(
     *     "/{id}/delete",
     *     methods={"GET", "DELETE"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="contact_delete",
     * )
     */
    public function delete(Request $request, Contact $contact, ContactRepository $contactRepository): Response
    {
        $form = $this->createForm(FormType::class, $contact, ['method' => 'DELETE']);
        $form->handleRequest($request);

        if ($request->isMethod('DELETE') && !$form->isSubmitted()) {
            $form->submit($request->request->get($form->getName()));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $contactRepository->delete($contact);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('contact_index');
        }

        return $this->render(
            'contact/delete.html.twig',
            [
                'form' => $form->createView(),
                'contact' => $contact,
            ]
        );
    }
}
