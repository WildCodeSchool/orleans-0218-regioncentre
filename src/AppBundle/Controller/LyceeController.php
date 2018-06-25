<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Lycee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Lycee controller.
 *
 * @Route("lycee")
 */
class LyceeController extends Controller
{
    /**
     * Lists all lycee entities.
     *
     * @Route("/", name="lycee_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lycees = $em->getRepository('AppBundle:Lycee')->findAll();

        return $this->render('lycee/index.html.twig', array(
            'lycees' => $lycees,
        ));
    }

    /**
     * Creates a new lycee entity.
     *
     * @Route("/new", name="lycee_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $lycee = new Lycee();
        $form = $this->createForm('AppBundle\Form\LyceeType', $lycee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lycee);
            $em->flush();

            return $this->redirectToRoute('lycee_show', array('id' => $lycee->getId()));
        }

        return $this->render('lycee/new.html.twig', array(
            'lycee' => $lycee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a lycee entity.
     *
     * @Route("/{id}", name="lycee_show")
     * @Method("GET")
     */
    public function showAction(Lycee $lycee)
    {
        $deleteForm = $this->createDeleteForm($lycee);

        return $this->render('lycee/show.html.twig', array(
            'lycee' => $lycee,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing lycee entity.
     *
     * @Route("/{id}/edit", name="lycee_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Lycee $lycee)
    {
        $deleteForm = $this->createDeleteForm($lycee);
        $editForm = $this->createForm('AppBundle\Form\LyceeType', $lycee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lycee_edit', array('id' => $lycee->getId()));
        }

        return $this->render('lycee/edit.html.twig', array(
            'lycee' => $lycee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a lycee entity.
     *
     * @Route("/{id}", name="lycee_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Lycee $lycee)
    {
        $form = $this->createDeleteForm($lycee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lycee);
            $em->flush();
        }

        return $this->redirectToRoute('lycee_index');
    }

    /**
     * Creates a form to delete a lycee entity.
     *
     * @param Lycee $lycee The lycee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lycee $lycee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lycee_delete', array('id' => $lycee->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
