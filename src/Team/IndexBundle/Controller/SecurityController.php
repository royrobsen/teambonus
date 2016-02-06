<?php

namespace Team\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        
        $lastUsername = $authenticationUtils->getLastUsername();
        
        $error = $authenticationUtils->getLastAuthenticationError();
        
        return $this->render(
            'TeamIndexBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error' => $error,
            )  
        );
    }
        
    public function loginCheckAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
    }    
    
}