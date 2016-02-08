<?php

namespace Team\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Team\IndexBundle\Entity\ArxfClubs;
use Symfony\Component\HttpFoundation\Cookie;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $request = $this->getRequest();
        
        $pageOffset = 0;
        
        if ($request->query->get('p')) {
            $page = $request->query->get('p');
            $pageOffset = ($page - 1) * 6;
        }
        
        $finder = $this->container->get('fos_elastica.finder.search.posts');
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
        $totalpages = ceil(count($finder->find($query))/6);
        $query->setSize(6);
        $query->setFrom($pageOffset);        
        $posts = $finder->find($query);

        return $this->render('TeamIndexBundle:Default:index.html.twig', array('posts' => $posts, 'totalpages' => $totalpages));
    }
    
    public function jsonclubsAction() {
      
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery( "SELECT c.clubName FROM TeamIndexBundle:ArxfClubs c");
        
        $clubs = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);;
        
        foreach ($clubs as $club) {
            $clublist[] = $club['clubName'];
        }
        
        $response = new Response();
        $response->setContent(json_encode($clublist));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
    
        public function jsonshopsAction() {
      
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery( "SELECT s.shopName FROM TeamIndexBundle:ArxfShops s");
        
        $shops = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);;
        
        foreach ($shops as$shop) {
            $shoplist[] = $shop['shopName'];
        }
        
        $response = new Response();
        $response->setContent(json_encode($shoplist));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
    
        public function impressumAction() {
            
            return $this->render('TeamIndexBundle:Static:impressum.html.twig');
            
        }
    
        public function faqAction() {
            
            return $this->render('TeamIndexBundle:Static:faq.html.twig');
            
        }

        public function datenschutzAction() {
            
            return $this->render('TeamIndexBundle:Static:datenschutz.html.twig');
            
        }

        public function neuesteamAction() {
            
            return $this->render('TeamIndexBundle:Static:neuesteam.html.twig');
            
        }  
  
        public function teamsponsernAction() {
            
            return $this->render('TeamIndexBundle:Static:teamsponsern.html.twig');
            
        }        
  
        public function bonuserhaltenAction() {
            
            return $this->render('TeamIndexBundle:Static:bonuserhalten.html.twig');
            
        }           
        
        public function kontaktAction(Request $request) {
            
            
            $form = $this->createFormBuilder()
                    ->add('name', 'text', array ( 'label' => false, 'attr' => array ( 'class' => 'form-control' )))
                    ->add('email', 'email', array ( 'label' => false, 'attr' => array ( 'class' => 'form-control' )))
                    ->add('message', 'textarea', array ( 'label' => false, 'attr' => array ( 'class' => 'form-control' )))
                    ->add('save', 'submit', array ('label' => 'Abschicken', 'attr' => array ( 'class' => 'btn btn-info', 'style' => 'max-width: 100%;' )))
                    ->getForm();
            
            $form -> handleRequest ( $request );
            
            if ( $form -> isValid ()) {
                
                $data = $form->getData();   
                
                $message = \Swift_Message::newInstance()
                    ->setSubject('Kontaktmail')
                    ->setFrom('no-reply@teambonus.de')
                    ->setTo('info@teambonus.de')
                    ->setBody(
                        $this->renderView(
                            // app/Resources/views/Emails/registration.html.twig
                            'Emails/kontaktmail.html.twig',
                            array('data' => $data)
                        ),
                        'text/html'
                    );

                $this->get('mailer')->send($message);
                
                $this->get('session')->getFlashBag()->add('notice', 'Das war erfolgreich. Vielen Dank für deine Nachricht!');

            }
            
            return $this->render('TeamIndexBundle:Static:kontakt.html.twig', array('form'=>$form->createView()));        
            
        }
}
