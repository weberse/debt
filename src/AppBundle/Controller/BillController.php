<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Bill;
use AppBundle\Form\BillType;
use FOS\RestBundle\Controller\Annotations;

/**
 * Bill controller.
 *
 */
class BillController extends Controller
{

    /**
     * Lists all Bill entities.
     *
     * @Annotations\View(
     *  templateVar="events"
     * )
     */
    public function getBillsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:Bill')->findAll();

        return $events;
    }

    /**
     * Lists all Bill entities.
     *
     * @Annotations\View(
     *  templateVar="events"
     * )
     */
    public function getBillAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Bill $entity */
        $entity = $em->getRepository('AppBundle:Bill')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bill entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
//        dump($entity);die;
        return $entity;

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a new Bill entity.
     *
     * @Annotations\View(
     *  templateVar="index"
     * )
     */
    public function newBillsAction(Request $request)
    {
        $entity = new Bill();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('get_bill', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Bill entity.
     *
     */
    public function postBillsAction(Request $request)
    {
        $entity = new Bill();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('get_bill', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Bill entity.
     *
     * @param Bill $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Bill $entity)
    {
        $form = $this->createForm(new BillType(), $entity, array(
            'action' => $this->generateUrl('post_bills'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Bill entity.
     *
     * @Annotations\View(
     *  templateVar="index"
     * )
     */
    public function newBillAction()
    {
        $entity = new Bill();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Bill entity.
     *
     * @Annotations\View(
     *  templateVar="index"
     * )
     */
    public function editBillAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bill')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bill entity.');
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
    * Creates a form to edit a Bill entity.
    *
    * @param Bill $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Bill $entity)
    {
        $form = $this->createForm(new BillType(), $entity, array(
            'action' => $this->generateUrl('update_bill', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Bill entity.
     *
     */
    public function updateBillAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bill')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bill entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('edit_bill', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Bill entity.
     *
     */
    public function deleteBillAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Bill')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bill entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('get_bills'));
    }

    /**
     * Creates a form to delete a Bill entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_bill', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
