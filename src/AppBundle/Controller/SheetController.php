<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Sheet;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sheet controller.
 */
class SheetController extends Controller
{
    const WAITING = 'waiting';

    private $mailer;
    private $templating;

    /**
     * SheetController constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $templating
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * Lists all sheet entities.
     *
     * @Route("lycee/sheet/", name="lycee_sheet_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sheets = $em->getRepository('AppBundle:Sheet')->findAll();

        return $this->render('/school/index.html.twig', array(
            'sheets' => $sheets,
        ));
    }

    /**
     * Creates a new sheet entity.
     *
     * @Route("lycee/sheet/new", name="lycee_sheet_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sheet = new Sheet();
        $status = $this->getDoctrine()->getManager()->getRepository('AppBundle:Statut')->findOneByCode(self::WAITING);
        $sheet->setStatus($status);
        $form = $this->createForm('AppBundle\Form\SheetType', $sheet);
        $form
            ->remove("status")
            ->remove("analysis");
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $sheet->setUser($this->getUser());
            $em->persist($sheet);
            $em->flush();
            $this->addFlash(
                'success',
                'La fiche a été ajoutée avec succès.'
            );

            return $this->redirectToRoute('sheet_show', array('id' => $sheet->getId()));
        }

        return $this->render('sheet/new.html.twig', array(
            'sheet' => $sheet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sheet entity.
     *
     * @Route("sheet/{id}", name="sheet_show")
     * @Method({"GET", "POST"})
     */
    public function showAction(Sheet $sheet, Request $request)
    {
        $comment = new Comment();
        $form = $this->createForm('AppBundle\Form\CommentType', $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $comment->setUser($this->getUser());
            $comment->setSheet($sheet);
            $em->persist($comment);
            $em->flush();
            $this->addFlash('comment', 'Nouveau message ajouté avec succès.');

            return $this->redirectToRoute('sheet_show', [
                'id' => $sheet->getId(),
                '_fragment' => 'msg_anchor'
            ]);
        }

        return $this->render('sheet/show.html.twig', array(
            'sheet' => $sheet,
            'comment' => $comment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sheet entity.
     *
     * @Route("emop/sheet/{id}/edit", name="emop_sheet_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sheet $sheet)
    {

        $deleteForm = $this->createDeleteForm($sheet);
        $editForm = $this->createForm('AppBundle\Form\SheetType', $sheet);
        $editForm
            ->remove("urgent")
            ->remove("subject")
            ->remove("job")
            ->remove("buildings")
            ->remove("constraintsBuildings")
            ->remove("constraintsTechnicals")
            ->remove("description");

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $sheet->setAnalysisDate(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();
            $this->sendStatus($sheet);

            return $this->redirectToRoute('emop_sheet_edit', array('id' => $sheet->getId()));
        }

        return $this->render('emop/sheet_edit.html.twig', array(
            'sheet' => $sheet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function sendStatus(Sheet $sheet)
    {
        $email = $sheet->getUser()->getMail();
        $body = $this->templating->render('email/status_change.html.twig');
        $message = (new \Swift_Message('Un statut vient de changer'))
        ->setFrom($email)
        ->setTo($email)
        ->setBody($body, 'text/html');
        $this->mailer->send($message);
    }

    /**
     * Deletes a sheet entity.
     *
     * @Route("admin/sheet/{id}", name="sheet_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sheet $sheet)
    {
        $form = $this->createDeleteForm($sheet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sheet);
            $em->flush();
        }

        return $this->redirectToRoute('admin_sheet_sheet_index');
    }

    /**
     * Creates a form to delete a sheet entity.
     *
     * @param Sheet $sheet The sheet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sheet $sheet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sheet_delete', array('id' => $sheet->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
