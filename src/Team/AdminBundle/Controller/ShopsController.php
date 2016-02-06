<?php

namespace Team\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Team\AdminBundle\Form\Type\ShopsType;
use Team\IndexBundle\Entity\ArxfShops;


class ShopsController extends Controller
{
    public function allAction()
    {
        return $this->render('TeamAdminBundle:Shops:all.html.twig');
    }
    
    public function jsonallshopsAction() {

        $request = $this->getRequest();
                
        $shops = $this->getDoctrine()
                ->getRepository('TeamIndexBundle:ArxfShops');
                
        $queryShops = $shops->createQueryBuilder('s')
                ->select('s')
                ->groupBy('s.id')
                ->getQuery();
                
        $shops = $queryShops->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
               
        $data = array('data' => array());

        foreach ($shops as $shop) {
                        
            $data['data'][] = array($shop['shopName'], $shop['id']);
            
        }

        $response = new Response();
        $response->setContent(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
    
    public function shopAction($id, Request $request) {
         
        $shop = new ArxfShops();
        
        $em = $this->getDoctrine()->getManager();

        $shop = $em->getRepository('TeamIndexBundle:ArxfShops')->find($id);
        
        
        if ( !$shop ) {
            throw $this->createNotFoundException(
                     'Kein Shop mit der Id: ' . $id );
        }

            $form = $this->createForm(new ShopsType(), $shop);    

                $form->handleRequest($request);
                
                if ($form->isValid()) {
                                      
                    $em->persist($shop);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', 'Änderungen wurden erfolgreich gespeichert!');
                    
                    return $this->render('TeamAdminBundle:Shops:shop.html.twig', array('form' => $form->createView(), 'shop' => $shop));
                   
                }
        
        return $this->render('TeamAdminBundle:Shops:shop.html.twig', array('form' => $form->createView(), 'shop' => $shop));
        
    }    
}
