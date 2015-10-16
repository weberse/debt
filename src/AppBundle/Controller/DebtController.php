<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Debt;
use AppBundle\Form\DebtType;
use FOS\RestBundle\Controller\Annotations;

/**
 * Debt controller.
 *
 */
class DebtController extends Controller
{

    /**
     * Lists all Debt entities.
     *
     * @Annotations\View
     *
     */
    public function getDebtsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Debt')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Debt entity.
     *
     * @Annotations\View
     *
     */
    public function newDebtAction(Request $request)
    {
        $entity = new Debt();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('get_debt', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Debt entity.
     *
     * @Annotations\View
     *
     */
    public function postDebtAction(Request $request)
    {
        $entity = new Debt();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('get_debt', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Debt entity.
     *
     * @param Debt $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Debt $entity)
    {
        $form = $this->createForm(new DebtType(), $entity, array(
            'action' => $this->generateUrl('post_debt'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Debt entity.
     *
     */
    public function newAction()
    {
        $entity = new Debt();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Debt entity.
     *
     * @Annotations\View
     *
     */
    public function getDebtAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Debt')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Debt entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Debt entity.
     *
     * @Annotations\View
     *
     */
    public function editDebtAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Debt')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Debt entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Debt entity.
    *
    * @param Debt $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Debt $entity)
    {
        $form = $this->createForm(new DebtType(), $entity, array(
            'action' => $this->generateUrl('update_debt', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Debt entity.
     *
     * @Annotations\View
     *
     */
    public function updateDebtAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Debt')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Debt entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('debt_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Debt entity.
     *
     */
    public function deleteDebtAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Debt')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Debt entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('debt'));
    }

    /**
     * Creates a form to delete a Debt entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_debt', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
