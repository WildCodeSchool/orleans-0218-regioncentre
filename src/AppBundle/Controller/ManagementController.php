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
     * @Route("/{list}", name="admin_management")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function managementAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $list = $request->attributes->get('_route_params');
        $em = $this->getDoctrine()->getManager();
        $departments = $em->getRepository(Department::class)->findAll();
        $form = $this->createForm('AppBundle\Form\HistorySheetType');
        $form->handleRequest($request);

        $data = $form->getData();
        $department = $data['Filtrer'];

        if ($list = 'school') {
            if ($form->isSubmitted() && $form->isValid() && $department != null) {
                $school = $em->getRepository(Lycee::class)->findByDepartment($department);
            } else {
                $school = $em->getRepository(Lycee::class)->findBy([], ['postalCode' => 'ASC'], 5);
            }
        }
        if ($list = 'user') {
            if ($form->isSubmitted() && $form->isValid() && $department != null) {
                $user = $em->getRepository(User::class)->findByDepartment($department);
            } else {
                $user = $em->getRepository(User::class)->findAll();
            }
        }
        if ($list = 'job') {
            $job = $em->getRepository(Metier::class)->findAll();
        }
        if ($list = 'status') {
            $status = $em->getRepository(Statut::class)->findAll();
        }
        if ($list = 'analysis') {
            $analysis = $em->getRepository(Analysis::class)->findAll();
        }


        return $this->render('admin/management.html.twig', array(
            'school' => $school,
            'list' => $list,
            'user' => $user,
            'job' => $job,
            'status' => $status,
            'analysis' => $analysis,
            'departments' => $departments,
            'form' => $form->createView(),
        ));
    }
}

