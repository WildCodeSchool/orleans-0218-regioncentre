<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 06/06/18
 * Time: 10:31
 */

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Department;
use AppBundle\Entity\Sheet;
use AppBundle\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class HistorySheetController extends Controller
{
    /**
     *
     * @Route("/admin/history", name="admin_history_sheets")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $departments = $em->getRepository(Department::class)->findAll();

        $form = $this->createForm('AppBundle\Form\HistorySheetType');
        $form->handleRequest($request);

        $data = $form->getData();
        $department = $data['filter'];
        if ($form->isSubmitted() && $form->isValid() && $department != null) {
            $sheets = $em->getRepository(Sheet::class)->findSheetsByDepartment($department->getName());
        } else {
            $sheets = $em->getRepository(Sheet::class)->findAll();
        }

        return $this->render('admin/history.html.twig', [
            'sheets' => $sheets,
            'departments' => $departments,
            'form' => $form->createView(),
        ]);
    }

    /**
     *
     * @Route("/emop/history", name="emop_history_sheets")
     * @Method("GET")
     */
    public function indexEmopAction()
    {
        $sheets = $this->getDoctrine()->getManager()->getRepository(Sheet::class)->findAll();
        return $this->render('emop/history_emop.html.twig', [
            'sheets' => $sheets,
        ]);
    }
}