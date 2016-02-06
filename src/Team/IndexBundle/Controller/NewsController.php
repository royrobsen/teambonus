<?php

namespace Team\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Team\IndexBundle\Entity\WpPosts;


class NewsController extends Controller
{
    public function singleNewsAction($id)
    {
        $id = explode('-', $id);
                
        $id = $id[0];      
        
        $em = $this->getDoctrine()->getManager();
        
        $post = $em->getRepository('TeamIndexBundle:WpPosts')->find($id); 
        
        return $this->render('TeamIndexBundle:News:singlenews.html.twig', array('post' => $post));

    }
    
    public function newsAction(Request $request)
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
        
        return $this->render('TeamIndexBundle:News:news.html.twig', array('posts' => $posts, 'totalpages' => $totalpages));
        
    }
}
