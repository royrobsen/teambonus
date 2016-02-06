<?php

namespace Team\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Team\IndexBundle\Entity\ArxfClubs;
use Team\IndexBundle\Entity\ArxfTeams;
use Symfony\Component\HttpFoundation\Cookie;
use Team\AdminBundle\Form\Type\ClubsType;
use Team\AdminBundle\Form\Type\TeamsType;

class ClubsController extends Controller
{
    public function clubsAction(Request $request)
    {  
        $request = $this->getRequest();
        
        $pageOffset = 0;
        
        if ($request->query->get('p')) {
            $page = $request->query->get('p');
            $pageOffset = ($page - 1) * 24;
        }
        
        $finder = $this->container->get('fos_elastica.finder.search.clubs');
        $boolQuery = new \Elastica\Query\BoolQuery();
        

        if ($request->query->get('q')) {
            $search = $request->query->get('q');

            $fieldQuery = new \Elastica\Query\Match();
            $fieldQuery->setFieldQuery('allField', $search);
            $fieldQuery->setFieldOperator('allField', 'AND');
            $fieldQuery->setFieldMinimumShouldMatch('allField', '80%');
            $fieldQuery->setFieldAnalyzer('allField', 'custom_search_analyzer');
            $boolQuery->addMust($fieldQuery);
        }  else {
            $fieldQuery = new \Elastica\Query\MatchAll();
        }

        $query = new \Elastica\Query();
        $query->setQuery($boolQuery);
        $query->setSize(1000);
        $totalpages = ceil(count($finder->find($query))/12);
        $query->setSize(12);
        $query->setFrom($pageOffset);        
        $clubs = $finder->find($query);


        return $this->render('TeamIndexBundle:Clubs:clubs.html.twig', array('clubs' => $clubs, 'totalpages' => $totalpages));
    }
    
    public function jsonfullclubsAction(Request $request) {
      
        $request = $this->getRequest();
        
        $search = $request->query->get('search'); 
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery( "SELECT c FROM TeamIndexBundle:ArxfClubs c WHERE c.active = :active");
        $query->setParameter('active', '1');
        
        $clubs = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
               
        $response = new Response();
        $response->setContent(json_encode($clubs));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
    
    public function jsonteamlistAction(Request $request) {
      
        $request = $this->getRequest();
        
        $search = $request->query->get('search'); 
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery( "SELECT t FROM TeamIndexBundle:ArxfTeams t WHERE t.clubRef = :search");
        $query->setParameter('search', $search);
        
        $teams = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
               
        $response = new Response();
        $response->setContent(json_encode($teams));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
    
    public function teamAction($teammatch) {
      
        $teamid = explode("-",$teammatch);
        $teamid = $teamid[0];
        
        $em = $this->getDoctrine()->getManager();
        
        $query = $em->createQuery( "SELECT t, c FROM TeamIndexBundle:ArxfTeams t JOIN t.club c WHERE t.id = :teamid");
        $query->setParameter('teamid', $teamid);
        $team = $query->getSingleResult();
        
        $querySales = $em->createQuery( "SELECT SUM(sa.saleTeam)*2 as sumValue FROM TeamIndexBundle:ArxfSales sa WHERE sa.teamRef = :teamid AND sa.state = :state");
        $querySales->setParameter('teamid', $teamid);
        $querySales->setParameter('state', 0);

        $progress = $querySales->getResult();

        if ( !$team ) {
            throw $this->createNotFoundException(
                     'Kein Verein mit der Id: ' . $team );
        }

        return $this->render('TeamIndexBundle:Clubs:team.html.twig', array('team' => $team, 'progress' => $progress)); 
         

    }
    
    public function addAction($id) {
                   
        $em = $this->getDoctrine()->getManager();
        
        $query = $em->createQuery( "SELECT t, c FROM TeamIndexBundle:ArxfTeams t JOIN t.club c WHERE t.id = :teamid");
        $query->setParameter('teamid', $id);

        $team = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);;

            $teamId = new Cookie('teambonus', $team[0]['id'], (time() + 3600 * 24 * 7), '/');
            $clubName = new Cookie('teambonusClub', $team['0']['club']['clubName'], (time() + 3600 * 24 * 7), '/');
            $teamName = new Cookie('teambonusTeam', $team['0']['teamName'], (time() + 3600 * 24 * 7), '/');
            $response = new Response();
            $response->headers->setCookie($teamId);
            $response->headers->setCookie($clubName);
            $response->headers->setCookie($teamName);
            $response->send();  
            
        $this->get('session')->getFlashBag()->add('notice', 'Wähle jetzt einen Shop deiner Wahl und sammel Geld für dein Team!');
            
        return $this->redirectToRoute('team_shops_all');
        
    }

    public function newAction(Request $request) {
         
        $club = new ArxfClubs();
        
        $em = $this->getDoctrine()->getManager();
 
        $form = $this->createForm(new ClubsType(), $club);    

            $form->handleRequest($request);
                
                if ($form->isValid()) {
                    
                    $club->setActive(0);
                    $club->setClubPic('nopic.jpg');
                    $em->persist($club);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', 'Vielen Dank! Der Verein wurde erfolgreich eingetragen. Du hast nun die Möglichkeit dein Team zu deinem Verein zu erstellen!');
                    
                    return $this->redirect($this->generateUrl('team_new_team', array('id' => $club->getId()), true));
                    
                }
        
        return $this->render('TeamIndexBundle:Clubs:neu.html.twig', array('form' => $form->createView()));
        
    }    

    public function newTeamAction($id, Request $request) {
         
        $team = new ArxfTeams();

        $em = $this->getDoctrine()->getManager();
        
        $id = explode("-",$id);
        $id = $id[0];
        
        $club = $em->getRepository('TeamIndexBundle:ArxfClubs')->find($id);
        
        $form = $this->createForm(new TeamsType(), $team);  
        
        $form->remove('bic');
        $form->remove('iban');
        $form->remove('blz');
        $form->remove('accNo');
        $form->remove('bankName');
        $form->remove('accOwner');
        
                $form->handleRequest($request);
                
                if ($form->isValid()) { 
                    
                    $team->setClub($club);
                    $team->setSportRef(0);
                    $team->setPasspalabra('test1234');
                    $team->setTeamPic('nopic.jpg');
                    $team->setTeamRefid(0);
                    $em->persist($team);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', 'Dein Team wurde erfolgreich eingetragen. Wir werden deine Anmeldung überprüfen und schicken dir eine Bestätigung per E-Mail!');
                    
                    return $this->render('TeamIndexBundle:Clubs:neuTeam.html.twig', array('form' => $form->createView(), 'club' => $club));
                   
                }
        
        return $this->render('TeamIndexBundle:Clubs:neuTeam.html.twig', array('form' => $form->createView(), 'club' => $club));
        
    }  
}
