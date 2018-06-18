<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
     * @Route("/", name="admin_management")
     * @Method("GET")
     */
    public function managementAction()
    {
        return $this->render('admin/management.html.twig');
    }
}
