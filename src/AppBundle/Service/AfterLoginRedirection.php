<?php
/**
 * Created by PhpStorm.
 * User: wilder18
 * Date: 21/06/18
 * Time: 15:37
 */

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

/**
 * Class AfterLoginRedirection
 * @package AppBundle\AppListener
 */
class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    private $router;

    /**
     * AfterLoginRedirection constructor.
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $roles = $token->getRoles();

        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);

        if (in_array('ROLE_ADMIN', $rolesTab, true)) {
            return new RedirectResponse($this->router->generate('admin_home_sheets'));
        } elseif (in_array('ROLE_EMOP', $rolesTab, true)) {
            return new RedirectResponse($this->router->generate('emop_home_sheets'));
        } elseif (in_array('ROLE_LYCEE', $rolesTab, true)) {
            return new RedirectResponse($this->router->generate('lycee_sheet_index'));
        }


    }
}
