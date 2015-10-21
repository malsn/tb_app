<?php

namespace AppBundle\Controller;

use AppBundle\Entity\dEntry;
use AppBundle\Form\Type\FirmType;
use AppBundle\Form\Type\FizType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

class ManageController extends Controller
{
	/**
	* @Route( name="create_entry", path="/{type}/create", requirements={
	*     "type": "fiz|firm"
	* })
	*/
	public function createAction( $type, Request $request )
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
			throw new AccessDeniedException();
		}
		
		$entry = new dEntry();

		$form = $this->getFormType($type, $entry);		
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$entry->setType($type);
			$em = $this->getDoctrine()->getManager();
			$em->persist($entry);
			$em->flush();
			return $this->redirect($this->generateUrl('show_entry', array ('type' => $type )));
		}


		return $this->render('book/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
	
	/**
	* @Route( name="edit_entry", path="/{type}/{id}/edit", requirements={
	*     "type": "fiz|firm", "id" = "\d+"
	* })
	*/
    public function editAction( $type, $id, Request $request )
    {		
		if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
			throw new AccessDeniedException();
		}
		
		$em = $this->getDoctrine()->getManager();
		$entry = $em->getRepository('AppBundle:dEntry')->findOneBy(
			array('id' => $id, 'type' => $type)
			);
		
		if (!$entry) {
			throw $this->createNotFoundException(
				'No '.$type.' found for id '.$id
			);
		}
		
		$form = $this->getFormType($type, $entry);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($entry);
			$em->flush();
			return $this->redirect($this->generateUrl('show_entry', array('type'=>$type)));
		}
		
		return $this->render('book/edit.html.twig', array(
			'edit_form' => $form->createView(),
		));
    }
	
	/**
	* @Route( name="delete_entry", path="/{type}/{id}/delete", requirements={
	*     "type": "fiz|firm", "id" = "\d+"
	* })
	*/
    public function deleteAction( $type, $id )
    {		
		if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
			throw new AccessDeniedException();
		}
		
		$em = $this->getDoctrine()->getManager();
		$entry = $em->getRepository('AppBundle:dEntry')->findOneBy(
			array('id' => $id, 'type' => $type)
			);
		
		if (!$entry) {
			throw $this->createNotFoundException(
				'No '.$type.' found for id '.$id
			);
		}		
		
		$em = $this->getDoctrine()->getManager();
		$em->remove($entry);
		$em->flush();
		
		return $this->redirect($this->generateUrl('show_entry', array('type'=>$type)));
		
    }
	
	private function getFormType($type, $entry)	{
		switch ($type) {
		case ('firm'):
			return $this->createForm( new FirmType(), $entry );
		break;
		case ('fiz'):
			return $this->createForm( new FizType(), $entry );
		break;
		}
	}
	
}
