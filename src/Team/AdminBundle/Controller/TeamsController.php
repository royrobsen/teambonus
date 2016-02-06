<?php

namespace Team\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Team\AdminBundle\Form\Type\TeamsType;
use Team\IndexBundle\Entity\ArxfTeams;


class TeamsController extends Controller
{
    public function allAction()
    {
        return $this->render('TeamAdminBundle:Teams:all.html.twig');
    }
    
    public function jsonallteamsAction() {

        $request = $this->getRequest();
                
        $clubs = $this->getDoctrine()
                ->getRepository('TeamIndexBundle:ArxfClubs');
                
        $queryClubs = $clubs->createQueryBuilder('c')
                ->select('c')
                ->groupBy('c.id')
                ->getQuery();
                
        $clubs = $queryClubs->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
               
        $data = array('data' => array());

        foreach ($clubs as $club) {
            
            $teams = $this->getDoctrine()
                    ->getRepository('TeamIndexBundle:ArxfTeams');

            $queryTeams = $teams->createQueryBuilder('t')
                    ->select('count(t) as countedTeams')
                    ->where('t.clubRef = :id')
                    ->setParameter(':id', $club['id'])
                    ->getQuery();

            $teams = $queryTeams->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            
            $data['data'][] = array($club['clubName'], $teams['0']['countedTeams'], "0,00 €", $club['id']);
            
        }

        $response = new Response();
        $response->setContent(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
    
    public function teamsAction($id, Request $request) {
         
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
                    
                    return $this->render('TeamAdminBundle:Teams:team.html.twig', array('form' => $form->createView(), 'team' => $team, 'club' => $club));
                   
                }
        
        return $this->render('TeamAdminBundle:Teams:team.html.twig', array('form' => $form->createView(), 'team' => $team, 'club' => $club));
        
    }    
}
