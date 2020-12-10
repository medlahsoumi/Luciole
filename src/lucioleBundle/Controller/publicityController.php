<?php

namespace lucioleBundle\Controller;

use lucioleBundle\Entity\publicity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

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
            $publicity->setVideo("abccc");
            $em = $this->getDoctrine()->getManager();
            $em->persist($publicity);
            $em->flush();

            return $this->redirectToRoute('show-luciole', array('id' => $publicity->getId()));
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
    public function show2Action() {
        $repository  = $this->getDoctrine() ->getRepository(publicity::class);
        $publicity = $repository->findAll();
        return $this->render(
            'publicity/show.html.twig',
            array('publicity' => $publicity)
        );
    }
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
    public function deleteAction($id) {

        $em = $this->getDoctrine()->getManager();
        $pub = $em->getRepository('lucioleBundle:publicity')->find($id);

        if (!$pub) {
            throw $this->createNotFoundException(
                'There are no publicities with the following id: ' . $id
            );
        }

        $em->remove($pub);
        $em->flush();

        return $this->redirect('/publicity/show.html.twig');

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
