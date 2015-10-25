<?php

namespace AppBundle\Controller;

use AppBundle\Entity\dEntry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
	
	/**
	* @Route( name="show_entry", path="/{type}/show", requirements = { "type": "firm|fiz" } )
	*/
    public function showBookIndexAction( $type )
    {        
		
		if (!$this->get('security.context')->isGranted('ROLE_USER')) {
			throw new AccessDeniedException();
		}
		
		$em = $this->getDoctrine()->getManager();
		$entries = $em->getRepository('AppBundle:dEntry')->findByType(
			array('type' => $type)
			);
		return $this->render("book/{$type}_index.html.twig", array(
            'entries' => $entries
			));
    }
}
