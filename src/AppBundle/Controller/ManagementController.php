<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Analysis;
use AppBundle\Entity\Department;
use AppBundle\Entity\Lycee;
use AppBundle\Entity\Metier;
use AppBundle\Entity\Sheet;
use AppBundle\Entity\Statut;
use AppBundle\Entity\User;
use AppBundle\Repository\LyceeRepository;
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
    const LIMIT = 10;

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

        $department = null ;
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $department = $data['filter'];
        }
        $school = $em->getRepository(Lycee::class)->findSchoolOrderByDepartment($department);

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
     * @Route("/user/{page}", name="admin_manage_user")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userManagementAction(Request $request, int $page)
    {
        $em = $this->getDoctrine()->getManager();
        $departments = $em->getRepository(Department::class)->findAll();
        $form = $this->createForm('AppBundle\Form\HistorySheetType');
        $form->handleRequest($request);

        $user = $em->getRepository(User::class)->findAll();

        $nbrUser = sizeof($user);
        $pageMax = ceil($nbrUser/self::LIMIT);
        if ($page < 1) {
            $page = 1;
        }
        if ($page > $pageMax) {
            $page = $pageMax;
        }

        $offset = ($page - 1)*self::LIMIT;
        $user = $em->getRepository(User::class)->findUserByPage($offset);

        return $this->render('admin/management/user.html.twig', array(
            'user' => $user,
            'departments' => $departments,
            'form' => $form->createView(),
            'page' => $page,
            'pageMax' => $pageMax,
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
