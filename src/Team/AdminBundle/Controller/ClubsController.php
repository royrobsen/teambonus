<?php

namespace Team\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Team\AdminBundle\Form\Type\ClubsType;
use Team\IndexBundle\Entity\ArxfClubs;


class ClubsController extends Controller
{
    public function allAction()
    {
        return $this->render('TeamAdminBundle:Clubs:all.html.twig');
    }
    
    public function jsonallclubsAction() {

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
    
    public function clubAction($id, Request $request) {
         
        $club = new ArxfClubs();
        
        $em = $this->getDoctrine()->getManager();

        $club = $em->getRepository('TeamIndexBundle:ArxfClubs')->find($id);
        
        $query = $em->createQuery( "SELECT t, c FROM TeamIndexBundle:ArxfTeams t JOIN t.club c WHERE t.clubRef = :clubRef");
        $query->setParameter('clubRef', $id);
        
        $team = $query->getResult();
        
        if ( !$club ) {
            throw $this->createNotFoundException(
                     'Kein Verein mit der Id: ' . $id );
        }

            $form = $this->createForm(new ClubsType(), $club);    

                $form->handleRequest($request);
                
                if ($form->isValid()) {
                    
                    if($form['attachment']->getData()) {
                        $random = rand();
                        $dir = __DIR__ . '/../../../../web/uploads/clubs/';
                        $extension = $form['attachment']->getData()->getClientOriginalExtension();
                        $form['attachment']->getData()->move($dir, $random . '.' . $extension);
                        $player->setClubPic($random . '.' . $extension);
                    }
                    
                    $em->persist($club);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', 'Änderungen wurden erfolgreich gespeichert!');
                    
                    return $this->render('TeamAdminBundle:Clubs:club.html.twig', array('form' => $form->createView(), 'club' => $club, 'teams' => $team));
                   
                }
        
        return $this->render('TeamAdminBundle:Clubs:club.html.twig', array('form' => $form->createView(), 'club' => $club, 'teams' => $team));
        
    }    
}
