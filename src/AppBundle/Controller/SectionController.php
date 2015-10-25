<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Section;
use AppBundle\Form\Type\SectionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

class SectionController extends Controller
{
	/**
	 * @Route( name="create_section", path="/section/{section_id}/create", requirements = { "section_id": "\d+" } )
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
	public function createSectionAction(Request $request, $section_id ){

		if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
			throw new AccessDeniedException();
		}

		$em = $this->getDoctrine()->getManager();
		$section = $em->getRepository('AppBundle:Section')->find( $section_id );

		$sub_section = new Section();

		$form = $this->createForm( new SectionType(), $sub_section );
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$sub_section->setParentId($section_id);
			$sub_section->setCreatedAt(new \DateTime());
			$sub_section->setModifiedAt(new \DateTime());
			$em = $this->getDoctrine()->getManager();
			$em->persist($sub_section);
			$em->flush();
			return $this->redirect($this->generateUrl('edit_section', array ('section_id' => $sub_section->getId() )));
		}


		return $this->render('section/new.html.twig', array(
			'form' => $form->createView(), 'section' => $section
		));
	}

	/**
	 * @Route( name="edit_section", path="/section/{section_id}/edit", requirements = { "section_id": "\d+" } )
	 */
	public function editSectionAction( $section_id ){

		if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
			throw new AccessDeniedException();
		}

		$em = $this->getDoctrine()->getManager();
		$section = $em->getRepository('AppBundle:Section')->find( $section_id );
		$sub_sections = $em->getRepository('AppBundle:Section')->findBy(array('parentId' => $section_id));
		return $this->render('section/edit.html.twig', array(
			'sub_sections' => $sub_sections, 'section' => $section
		));
	}
}
