<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Metier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Metier controller.
 *
 * @Route("metier")
 */
class MetierController extends Controller
{
    /**
     * Lists all metier entities.
     *
     * @Route("/", name="metier_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $metiers = $em->getRepository('AppBundle:Metier')->findAll();

        return $this->render('metier/index.html.twig', array(
            'metiers' => $metiers,
        ));
    }

    /**
     * Creates a new metier entity.
     *
     * @Route("/new", name="metier_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $metier = new Metier();
        $form = $this->createForm('AppBundle\Form\MetierType', $metier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($metier);
            $em->flush();

            return $this->redirectToRoute('metier_new');
        }

        $pm = $this->getDoctrine()->getManager();

        $metiers = $pm->getRepository('AppBundle:Metier')->findAll();

        return $this->render('metier/new.html.twig', array(
            'metier' => $metier,
            'metiers' => $metiers,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a metier entity.
     *
     * @Route("/{id}", name="metier_show")
     * @Method("GET")
     */
    public function showAction(Metier $metier)
    {
        $deleteForm = $this->createDeleteForm($metier);

        return $this->render('metier/show.html.twig', array(
            'metier' => $metier,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing metier entity.
     *
     * @Route("/{id}/edit", name="metier_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Metier $metier)
    {
        $deleteForm = $this->createDeleteForm($metier);
        $editForm = $this->createForm('AppBundle\Form\MetierType', $metier);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('metier_edit', array('id' => $metier->getId()));
        }

        $pm = $this->getDoctrine()->getManager();

        $metiers = $pm->getRepository('AppBundle:Metier')->findAll();

        return $this->render('metier/edit.html.twig', array(
            'metier' => $metier,
            'metiers' => $metiers,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a metier entity.
     *
     * @Route("/{id}", name="metier_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Metier $metier)
    {
        $form = $this->createDeleteForm($metier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($metier);
            $em->flush();
        }

        return $this->redirectToRoute('metier_index');
    }

    /**
     * Creates a form to delete a metier entity.
     *
     * @param Metier $metier The metier entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Metier $metier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('metier_delete', array('id' => $metier->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
