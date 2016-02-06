<?php

namespace Team\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('TeamAdminBundle:Admin:index.html.twig');
    }
}
