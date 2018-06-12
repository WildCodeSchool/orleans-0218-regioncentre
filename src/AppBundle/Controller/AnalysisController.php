<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Analysis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * analysis controller.
 *
 * @Route("analysis")
 */
class AnalysisController extends Controller
{
    /**
     * Lists all analysis entities.
     *
     * @Route("/", name="analysis_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $analyzes = $em->getRepository('AppBundle:Analysis')->findAll();

        return $this->render('analysis/index.html.twig', array(
            'analyzes' => $analyzes,
        ));
    }

    /**
     * Creates a new analysis entity.
     *
     * @Route("/new", name="analysis_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $analysis = new Analysis();
        $form = $this->createForm('AppBundle\Form\AnalysisType', $analysis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($analysis);
            $em->flush();
            $this->addFlash(
                'success',
                'l\'analyse de demande a été ajouté avec succes.'
            );

            return $this->redirectToRoute('analysis_index');
        }

        return $this->render('analysis/new.html.twig', array(
            'analysis' => $analysis,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a analysis entity.
     *
     * @Route("/{id}", name="analysis_show")
     * @Method("GET")
     */
    public function showAction(Analysis $analysis)
    {
        $deleteForm = $this->createDeleteForm($analysis);

        return $this->render('analysis/show.html.twig', array(
            'analysis' => $analysis,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing analysis entity.
     *
     * @Route("/{id}/edit", name="analysis_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Analysis $analysis)
    {
        $deleteForm = $this->createDeleteForm($analysis);
        $editForm = $this->createForm('AppBundle\Form\AnalysisType', $analysis);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('analysis_edit', array('id' => $analysis->getId()));
        }

        return $this->render('analysis/edit.html.twig', array(
            'analysis' => $analysis,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a analysis entity.
     *
     * @Route("/{id}", name="analysis_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Analysis $analysis)
    {
        $form = $this->createDeleteForm($analysis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($analysis);
            $em->flush();
        }

        return $this->redirectToRoute('analysis_index');
    }

    /**
     * Creates a form to delete a analysis entity.
     *
     * @param analysis $analysis The analysis entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Analysis $analysis)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('analysis_delete', array('id' => $analysis->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
