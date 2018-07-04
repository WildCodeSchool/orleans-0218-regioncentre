<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Department;
use AppBundle\Entity\Lycee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Lycee controller.
 *
 * @Route("admin/lycee")
 */
class LyceeController extends Controller
{
    /**
     * Lists all lycee entities.
     *
     * @Route("/", name="admin_lycee_index")
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
     * @Route("/new", name="admin_lycee_new")
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
            $this->addFlash(
                'success',
                'Le lycée a été ajouté!'
            );
            return $this->redirectToRoute('admin_manage_school');
        }
        return $this->render('lycee/new.html.twig', array(
            'lycee' => $lycee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a lycee entity.
     *
     * @Route("/{id}", name="admin_lycee_show")
     * @Method("GET")
     */
    public function showAction(Lycee $lycee)
    {
        return $this->render('lycee/show.html.twig', array(
            'lycee' => $lycee,
        ));
    }

    /**
     * Displays a form to edit an existing lycee entity.
     *
     * @Route("/{id}/edit",  name="admin_lycee_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Lycee $lycee)
    {
        $editForm = $this->createForm('AppBundle\Form\LyceeType', $lycee);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Vos modifications ont été enregistrées!'
            );
            return $this->redirectToRoute('admin_lycee_edit', array('id' => $lycee->getId()));
        }
        return $this->render('lycee/edit.html.twig', array(
            'lycee' => $lycee,
            'edit_form' => $editForm->createView(),
        ));
    }
}
