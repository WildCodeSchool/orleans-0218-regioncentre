<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Comment controller.
 *
 * @Route("comment")
 */
class CommentController extends Controller
{
    /**
     * Lists all comment entities.
     *
     * @Route("/", name="comment_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('AppBundle:Comment')->findAll();

        return $this->render('comment/index.html.twig', array(
            'comments' => $comments,
        ));
    }

    /**
     * Creates a new comment entity.
     *
     * @Route("/new", name="comment_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $comment = new Comment();
        $form = $this->createForm('AppBundle\Form\CommentType', $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $comment->setUser($this->getUser());
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('comment_show', array('id' => $comment->getId()));
        }

        return [
            'comment' => $comment,
            'form' => $form->createView(),
        ];
    }

    /**
     * Finds and displays a comment entity.
     *
     * @Route("/{id}", name="comment_show")
     * @Method("GET")
     */
    public function showAction(Comment $comment)
    {
        $deleteForm = $this->createDeleteForm($comment);

        return $this->render('comment/show.html.twig', array(
            'comment' => $comment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing comment entity.
     *
     * @Route("/{id}/edit", name="comment_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Comment $comment)
    {
        $deleteForm = $this->createDeleteForm($comment);
        $editForm = $this->createForm('AppBundle\Form\CommentType', $comment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comment_edit', array('id' => $comment->getId()));
        }

        return $this->render('comment/edit.html.twig', array(
            'comment' => $comment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a comment entity.
     *
     * @Route("/{id}", name="comment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Comment $comment)
    {
        if ($this->getUser() !== $comment->getUser()) {
            $this->addFlash(
                'comment',
                'Impossible de supprimer ce message.'
            );
            return $this->redirectToRoute('sheet_show', [
                'id'=>$comment->getSheet()->getId(),
                '_fragment' => 'msg_anchor',
            ]);
        }
        $em = $this->getDoctrine()->getManager();
        $lastComments = $em->getRepository('AppBundle:Comment')
                           ->findBy(['sheet'=>$comment->getSheet()], ['date' => 'DESC'], 1);
        $lastComment = $lastComments[0] ?? null;

        if ($lastComment !== $comment) {
            $this->addFlash(
                'comment',
                'Impossible de supprimer ce message.'
            );
            return $this->redirectToRoute('sheet_show', [
                'id'=>$comment->getSheet()->getId(),
                '_fragment' => 'msg_anchor',
            ]);
        }
        $deleteform = $this->createDeleteForm($comment);
        $deleteform->handleRequest($request);

        $oldComment = $comment;

        if ($deleteform->isSubmitted() && $deleteform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comment);
            $em->flush();
            $this->addFlash(
                'comment',
                'Le message a été supprimé avec succès.'
            );
            return $this->redirectToRoute('sheet_show', [
                'id'=>$oldComment->getSheet()->getId(),
                '_fragment' => 'msg_anchor',
            ]);
        }
        return $this->render('comment/delete.html.twig', array(
            'delete_form' => $deleteform->createView(),
        ));
    }

    /**
     * Creates a form to delete a comment entity.
     *
     * @param Comment $comment The comment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Comment $comment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comment_delete', array('id' => $comment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
