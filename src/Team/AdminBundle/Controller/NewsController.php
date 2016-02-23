<?php

namespace Team\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Team\AdminBundle\Form\Type\PostsType;
use Team\IndexBundle\Entity\WpPosts;


class NewsController extends Controller
{
    public function allAction()
    {
        return $this->render('TeamAdminBundle:News:all.html.twig');
    }
    
    public function jsonallnewsAction() {

        $request = $this->getRequest();
                
        $posts = $this->getDoctrine()
                ->getRepository('TeamIndexBundle:WpPosts');
                
        $queryPosts = $posts->createQueryBuilder('wp')
                ->select('wp')
                ->groupBy('wp.id')
                ->getQuery();
                
        $posts = $queryPosts->getResult();
               
        $data = array('data' => array());

        foreach ($posts as $post) {     
            $data['data'][] = array($post->getPostTitle(), $post->getPostDate()->format('Y-m-d'), $post->getPostStatus(), $post->getId());    
        }

        $response = new Response();
        $response->setContent(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
    
    public function postAction($id, Request $request) {
         
        $post = new WpPosts();
        
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('TeamIndexBundle:WpPosts')->find($id);
        
            $form = $this->createForm(new PostsType(), $post);    

                $form->handleRequest($request);
                
                if ($form->isValid()) {
                    
                    $em->persist($post);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', 'Änderungen wurden erfolgreich gespeichert!');
                                       
                }
        
                return $this->render('TeamAdminBundle:News:post.html.twig', array('form' => $form->createView(), 'post' => $post));
        
    }    
    
    public function deleteAction($id) {
         
        $post = new WpPosts();
        
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('TeamIndexBundle:WpPosts')->find($id);
        
        $em->remove($post);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notice', 'Post wurde erfolgreich gelöscht!');
                                       
        return $this->redirectToRoute('team_admin_news');
        
    }    
    
    public function newAction(Request $request) {
         
        $post = new WpPosts();
        
        $em = $this->getDoctrine()->getManager();
        
        $form = $this->createForm(new PostsType(), $post);    

            $form->handleRequest($request);

            if ($form->isValid()) {
                
                $post->setPostAuthor('Admin');
                $post->setPostDate(new \DateTime());
                $post->setPostStatus('publish');

                $em->persist($post);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Post wurde erfolgreich gespeichert!');
                
                return $this->redirectToRoute('team_admin_news');
                
            }

            return $this->render('TeamAdminBundle:News:new.html.twig', array('form' => $form->createView()));
        
    }    
    
}
