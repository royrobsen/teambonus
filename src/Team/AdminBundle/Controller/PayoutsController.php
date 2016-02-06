<?php

namespace Team\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Team\AdminBundle\Form\Type\PayoutsType;
use Team\IndexBundle\Entity\ArxfPayout;


class PayoutsController extends Controller
{
    public function allAction()
    {
        return $this->render('TeamAdminBundle:Payouts:all.html.twig');
    }
    
    public function jsonallpayoutsAction() {

        $request = $this->getRequest();
                
        $payouts = $this->getDoctrine()
                ->getRepository('TeamIndexBundle:ArxfPayout');
                
        $queryPayouts = $payouts->createQueryBuilder('p')
                ->select('p')
                ->groupBy('p.id')
                ->getQuery();
                
        $payouts = $queryPayouts->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
               
        $data = array('data' => array());

        foreach ($payouts as $payout) {
            
            $teams = $this->getDoctrine()
                    ->getRepository('TeamIndexBundle:ArxfTeams');

            $queryTeams = $teams->createQueryBuilder('t')
                    ->where('t.id = :id')
                    ->setParameter(':id', $payout['teamRef'])
                    ->getQuery();

            $teams = $queryTeams->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            
            $em = $this->getDoctrine()->getManager();
            $club = $em->getRepository('TeamIndexBundle:ArxfClubs')->find($teams['0']['clubRef']);
            
            switch($payout['state']) {
                case 0:
                    $state = "Beantragt";
                    break;
                case 1:
                    $state = "Bestätigt";
                    break;
                case 2: 
                    $state = "Ausgezahlt";
                    break;
                case 3:
                    $state = "Abgelehnt";
                    break;
            }
            
            $data['data'][] = array($club->getClubName(), $teams['0']['teamName'], $payout['payValue'] . " €", $state, $payout['id']);
            
        }

        $response = new Response();
        $response->setContent(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
    
    public function payoutsAction($id, Request $request) {
         
        $payouts = new ArxfPayout();

        $em = $this->getDoctrine()->getManager();

        $payouts = $em->getRepository('TeamIndexBundle:ArxfPayout')->find($id);
        
        if ( !$payouts ) {
            throw $this->createNotFoundException(
                     'Kein Team mit der Id: ' . $id );
        }
        
        $teams = $this->getDoctrine()
                ->getRepository('TeamIndexBundle:ArxfTeams');

        $queryTeams = $teams->createQueryBuilder('t')
                ->where('t.id = :id')
                ->setParameter(':id', $payouts->getTeamRef())
                ->getQuery();

        $teams = $queryTeams->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        $club = $em->getRepository('TeamIndexBundle:ArxfClubs')->find($teams['0']['clubRef']);
        
            $form = $this->createForm(new PayoutsType(), $payouts);    

                $form->handleRequest($request);
                
                if ($form->isValid()) {
                                        
                    $em->persist($payouts);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', 'Änderungen wurden erfolgreich gespeichert!');
                    
                    return $this->render('TeamAdminBundle:Payouts:payouts.html.twig', array('form' => $form->createView(), 'payout' => $payouts, 'team' => $teams, 'club' => $club));
                   
                }
        
        return $this->render('TeamAdminBundle:Payouts:payouts.html.twig', array('form' => $form->createView(), 'payout' => $payouts, 'team' => $teams, 'club' => $club));
        
    }    
}
