<?php

namespace Team\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Team\IndexBundle\Entity\ArxfTeams;
use Team\AdminBundle\Form\Type\TeamsType;
use Symfony\Component\HttpFoundation\Cookie;

class ProfileController extends Controller
{
    
    public function profileAction($id, Request $request) {
         
        $team = new ArxfTeams();

        $em = $this->getDoctrine()->getManager();

        $team = $em->getRepository('TeamIndexBundle:ArxfTeams')->find($id);
        
        if ( !$team ) {
            throw $this->createNotFoundException(
                     'Kein Team mit der Id: ' . $id );
        }
        $club = $em->getRepository('TeamIndexBundle:ArxfClubs')->find($team->getClubRef());
        
            $form = $this->createForm(new TeamsType(), $team);    

                $form->handleRequest($request);
                
                if ($form->isValid()) {
                                        
                    $em->persist($team);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', 'Änderungen wurden erfolgreich gespeichert!');
                    
                    return $this->render('TeamIndexBundle:Profile:profile.html.twig', array('form' => $form->createView(), 'team' => $team, 'club' => $club));
                   
                }
        
        return $this->render('TeamIndexBundle:Profile:profile.html.twig', array('form' => $form->createView(), 'team' => $team, 'club' => $club));
        
    }    
        
}
