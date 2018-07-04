<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Analysis;
use AppBundle\Entity\Department;
use AppBundle\Entity\Lycee;
use AppBundle\Entity\Metier;
use AppBundle\Entity\Sheet;
use AppBundle\Entity\Statut;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ManagementController
 * @package AppBundle\Controller
 * @Route("admin/gestion")
 */
class ManagementController extends Controller
{
    /**
     * Management page
     * Listing of works.
     *
     * @Route("/school", name="admin_manage_school")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function schoolManageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $departments = $em->getRepository(Department::class)->findAll();
        $form = $this->createForm('AppBundle\Form\HistorySheetType');
        $form->handleRequest($request);

        $data = $form->getData();
        $department = $data['filter'];

        if ($form->isSubmitted() && $form->isValid() && $department != null) {
            $school = $em->getRepository(Lycee::class)
                ->findByDepartment($department, ['department' => 'DESC', 'name' => 'ASC']);
        } else {
            $school = $em->getRepository(Lycee::class)->findBy([], ['department' => 'DESC', 'name' => 'ASC']);
        }

        return $this->render('admin/management/school.html.twig', array(
            'school' => $school,
            'departments' => $departments,
            'form' => $form->createView(),
        ));
    }

    /**
     * Management page
     * Listing of works.
     *
     * @Route("/user", name="admin_manage_user")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userManagementAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $departments = $em->getRepository(Department::class)->findAll();
        $form = $this->createForm('AppBundle\Form\HistorySheetType');
        $form->handleRequest($request);

        $data = $form->getData();
        $department = $data['filter'];
        if ($form->isSubmitted() && $form->isValid() && $department != null) {
            $user = $em->getRepository(User::class)->findByDepartment($department);
        } else {
            $user = $em->getRepository(User::class)->findAll();
        }

        return $this->render('admin/management/user.html.twig', array(
            'user' => $user,
            'departments' => $departments,
            'form' => $form->createView(),
        ));
    }

    /**
     * Management page
     * Listing of works.
     *
     * @Route("/job", name="admin_manage_job")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function jobManagementAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $job = $em->getRepository(Metier::class)->findBy([], ['name' => 'ASC']);

        return $this->render('admin/management/job.html.twig', array(
            'job' => $job,
        ));
    }

    /**
     * Management page
     * Listing of works.
     *
     * @Route("/analyse", name="admin_manage_analyse")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function analyseManagementAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $analysis = $em->getRepository(Analysis::class)->findBy([], ['name' => 'ASC']);

        return $this->render('admin/management/analyse.html.twig', array(
            'analysis' => $analysis,
        ));
    }

    /**
     * Management page
     * Listing of works.
     *
     * @Route("/status", name="admin_manage_status")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function statusManagementAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $status = $em->getRepository(Statut::class)->findBy([], ['name' => 'ASC']);

        return $this->render('admin/management/status.html.twig', array(
            'status' => $status,
        ));
    }
}
