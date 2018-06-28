<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 * @Route("/fosuser")
 **/
class MaillerController extends Controller
{

    /**
     * @Route("{token}", name="user_activate")
     * @Method({"GET", "POST"})
     */
    public function confirmAction(Request $request, $token)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneByConfirmationToken($token);
        if (!$user) {
            return $this->redirectToRoute('fos_user_security_login');
        }

        $user->setConfirmationToken($token);
        $user->setEnabled(true);

        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('fos_user_resetting_reset');
    }
}
