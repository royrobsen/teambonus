<?php

namespace Team\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Team\IndexBundle\Entity\ArxfShops;
use Symfony\Component\HttpFoundation\Cookie;

class ShopsController extends Controller
{
    public function shopsAction(Request $request)
    {  
        $request = $this->getRequest();
        
        $pageOffset = 0;
        
        if ($request->query->get('p')) {
            $page = $request->query->get('p');
            $pageOffset = ($page - 1) * 24;
        }
        
        
        $search = ""; 
        if ($request->query->get('q')) {
            $search = $request->query->get('q');
        }

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery( "SELECT s FROM TeamIndexBundle:ArxfShops s WHERE s.shopName LIKE :search");
        $query->setParameter('search', '%' . $search . '%');
        
        $totalShops = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        $totalpages = ceil(count($totalShops)/24);
        
        $query->setFirstResult($pageOffset);
        $query->setMaxResults(24);
        
        $shops = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $this->render('TeamIndexBundle:Shops:shops.html.twig', array('shops' => $shops, 'totalpages' => $totalpages));
    }
    
    public function jsonfullshopsAction(Request $request) {
      
        $request = $this->getRequest();
        
        $search = $request->query->get('search'); 
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery( "SELECT s FROM TeamIndexBundle:ArxfShops s WHERE s.shopName LIKE :search");
        $query->setParameter('search', '%' . $search . '%');
        
        $shops = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
               
        $response = new Response();
        $response->setContent(json_encode($shops));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
  
    public function newShopAction(Request $request) {
           
            
            $form = $this->createFormBuilder()
                    ->add('shop', 'text', array ( 'label' => 'Shopname','attr' => array ( 'class' => 'form-control' )))
                    ->add('email', 'email', array ( 'attr' => array ( 'class' => 'form-control' )))
                    ->add('name', 'text', array ( 'label' => 'Dein Name','attr' => array ( 'class' => 'form-control' )))
                    ->add('website', 'text', array ( 'attr' => array ( 'class' => 'form-control' )))
                    ->add('message', 'textarea', array ('label' => 'Nachricht', 'attr' => array ( 'class' => 'form-control' )))
                    ->add('save', 'submit', array ('label' => 'Abschicken', 'attr' => array ( 'class' => 'btn btn-info', 'style' => 'max-width: 100%;' )))
                    ->getForm();
            
            $form -> handleRequest ( $request );
            
            if ( $form -> isValid ()) {
                
                $data = $form->getData();   
                
                $message = \Swift_Message::newInstance()
                    ->setSubject('Shopanfrage')
                    ->setFrom('no-reply@teambonus.de')
                    ->setTo('info@teambonus.de')
                    ->setBody(
                        $this->renderView(
                            // app/Resources/views/Emails/registration.html.twig
                            'Emails/newshopmail.html.twig',
                            array('data' => $data)
                        ),
                        'text/html'
                    );

                $this->get('mailer')->send($message);
                
                $this->get('session')->getFlashBag()->add('notice', 'Das war erfolgreich. Vielen Dank für deine Nachricht!');

            }
            
            return $this->render('TeamIndexBundle:Shops:newShop.html.twig', array('form'=>$form->createView()));        
            
    }    
    
}
