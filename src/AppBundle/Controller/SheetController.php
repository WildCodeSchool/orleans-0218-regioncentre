<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sheet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Sheet controller.
 */
class SheetController extends Controller
{
    const WAITING = 'waiting';

    /**
     * Lists all sheet entities.
     *
     * @Route("/sheet/", name="sheet_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sheets = $em->getRepository('AppBundle:Sheet')->findAll();

        return $this->render('/sheet/index.html.twig', array(
            'sheets' => $sheets,
        ));
    }

    /**
     * Creates a new sheet entity.
     *
     * @Route("lycee/sheet/new", name="/lycee/sheet_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sheet = new Sheet();
        $status = $this->getDoctrine()->getManager()->getRepository('AppBundle:Statut')->findOneByCode(self::WAITING);
        $sheet->setStatus($status);
        $form = $this->createForm('AppBundle\Form\SheetType', $sheet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $sheet->setUser($this->getUser());
            $em->persist($sheet);
            $em->flush();

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
     * @Method("GET")
     */
    public function showAction(Sheet $sheet)
    {
        $deleteForm = $this->createDeleteForm($sheet);

        return $this->render('sheet/show.html.twig', array(
            'sheet' => $sheet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sheet entity.
     *
     * @Route("emop/sheet/{id}/edit", name="/emop/sheet_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sheet $sheet)
    {
        $deleteForm = $this->createDeleteForm($sheet);
        $editForm = $this->createForm('AppBundle\Form\SheetType', $sheet);
        $editForm->handleRequest($request);
        $editForm
            ->remove("urgent")
            ->remove("subject")
            ->remove("job")
            ->remove("buildings")
            ->remove("constraintsBuildings")
            ->remove("constraintsTechnicals")
            ->remove("description");


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sheet_edit', array('id' => $sheet->getId()));
        }

        return $this->render('emop/sheet_edit.html.twig', array(
            'sheet' => $sheet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
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

        return $this->redirectToRoute('/admin/sheet/sheet_index');
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
