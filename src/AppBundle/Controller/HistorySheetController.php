<?php
/**
 * Created by PhpStorm.
 * User: workstation
 * Date: 06/06/18
 * Time: 10:31
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Department;
use AppBundle\Entity\Sheet;
use AppBundle\Entity\User;
use AppBundle\Entity\Lycee;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HistorySheetController extends Controller
{
    /**
     *
     * @Route("/admin/history", name="admin_history_sheets")
     * @Method("GET")
     */
    public function indexAction()
    {
        $sheets = $this->getDoctrine()->getManager()->getRepository(Sheet::class)->findAll();
        $departments = $this->getDoctrine()->getManager()->getRepository(Department::class)->findAll();
        $lycees =  $this->getDoctrine()->getManager()->getRepository(Lycee::class)->findAll();
        return $this->render('admin/history.html.twig', [
            'sheets' => $sheets,
            'lycees' => $lycees,
            'departments' => $departments,
            ]);
    }

    /**
     *
     * @Route("/emop/history", name="history_emop_sheets")
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
