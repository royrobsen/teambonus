<?php

namespace Team\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Team\IndexBundle\Entity\ArxfSales;


class SalesController extends Controller
{
    public function allAction()
    {
        return $this->render('TeamAdminBundle:Sales:all.html.twig');
    }
    
    public function jsonallsalesAction() {

        $request = $this->getRequest();
                
        $sales = $this->getDoctrine()
                ->getRepository('TeamIndexBundle:ArxfSales');
                
        $querySales = $sales->createQueryBuilder('s')
                ->select('s')
                ->groupBy('s.id')
                ->getQuery();
                
        $sales = $querySales->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
               
        $data = array('data' => array());

        foreach ($sales as $sale) {
            
            $teams = $this->getDoctrine()
                    ->getRepository('TeamIndexBundle:ArxfTeams');

            $queryTeams = $teams->createQueryBuilder('t')
                    ->where('t.id = :id')
                    ->setParameter(':id', $sale['teamRef'])
                    ->getQuery();

            $teams = $queryTeams->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            
            $em = $this->getDoctrine()->getManager();
            $club = $em->getRepository('TeamIndexBundle:ArxfClubs')->find($teams['0']['clubRef']);
            
            switch($sale['state']) {
                case 0:
                    $state = "Offen";
                    break;
                case 1:
                    $state = "Bestätigt";
                    break;
                case 2: 
                    $state = "Ausgezahlt";
                    break;
            }
            $date = $sale['dateSale'];
            $data['data'][] = array($club->getClubName(), $teams['0']['teamName'], $sale['sale'] . " €", $state, $sale['dateSale']->format('d.m.Y H:i:s'),$sale['id']);
            
        }

        $response = new Response();
        $response->setContent(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
    
    public function saleAction($id, Request $request) {
         
        $sale = new ArxfSales();

        $em = $this->getDoctrine()->getManager();

        $sale = $em->getRepository('TeamIndexBundle:ArxfSales')->find($id);
        
        if ( !$sale ) {
            throw $this->createNotFoundException(
                     'Kein Kauf mit der Id: ' . $id );
        }
        
        $teams = $this->getDoctrine()
                ->getRepository('TeamIndexBundle:ArxfTeams');

        $queryTeams = $teams->createQueryBuilder('t')
                ->where('t.id = :id')
                ->setParameter(':id', $sale->getTeamRef())
                ->getQuery();

        $teams = $queryTeams->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        $club = $em->getRepository('TeamIndexBundle:ArxfClubs')->find($teams['0']['clubRef']);
        
        
        return $this->render('TeamAdminBundle:Sales:sale.html.twig', array('sale' => $sale, 'team' => $teams, 'club' => $club));
        
    }    
}
