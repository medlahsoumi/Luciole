<?php

namespace lucioleBundle\Controller;

use lucioleBundle\Entity\publicity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Publicity controller.
 *
 * @Route("publicity")
 */
class publicityController extends Controller
{
    /**
     * Lists all publicity entities.
     *
     * @Route("/", name="publicity_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publicities = $em->getRepository('lucioleBundle:publicity')->findAll();

        return $this->render('publicity/index.html.twig', array(
            'publicities' => $publicities,
        ));
    }

    /**
     * Creates a new publicity entity.
     *
     * @Route("/new", name="publicity_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $publicity = new Publicity();
        $form = $this->createForm('lucioleBundle\Form\publicityType', $publicity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($publicity);
            $em->flush();

            return $this->redirectToRoute('publicity_show', array('id' => $publicity->getId()));
        }

        return $this->render('publicity/new.html.twig', array(
            'publicity' => $publicity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a publicity entity.
     *
     * @Route("/{id}", name="publicity_show")
     * @Method("GET")
     */
    public function showAction(publicity $publicity)
    {
        $deleteForm = $this->createDeleteForm($publicity);

        return $this->render('publicity/show.html.twig', array(
            'publicity' => $publicity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing publicity entity.
     *
     * @Route("/{id}/edit", name="publicity_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, publicity $publicity)
    {
        $deleteForm = $this->createDeleteForm($publicity);
        $editForm = $this->createForm('lucioleBundle\Form\publicityType', $publicity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publicity_edit', array('id' => $publicity->getId()));
        }

        return $this->render('publicity/edit.html.twig', array(
            'publicity' => $publicity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a publicity entity.
     *
     * @Route("/{id}", name="publicity_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, publicity $publicity)
    {
        $form = $this->createDeleteForm($publicity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publicity);
            $em->flush();
        }

        return $this->redirectToRoute('publicity_index');
    }

    /**
     * Creates a form to delete a publicity entity.
     *
     * @param publicity $publicity The publicity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(publicity $publicity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('publicity_delete', array('id' => $publicity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
