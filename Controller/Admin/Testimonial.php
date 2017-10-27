<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Testimonials\Controller\Admin;

use Cms\Controller\Admin\AbstractController;
use Krystal\Validate\Pattern;
use Krystal\Stdlib\VirtualEntity;

final class Testimonial extends AbstractController
{
    /**
     * Creates a form
     * 
     * @param \Krystal\Stdlib\VirtualEntity|array $testimonial
     * @param string $title
     * @return string
     */
    private function createForm($testimonial, $title)
    {
        // Append breadcrumbs
        $this->view->getBreadcrumbBag()->addOne('Testimonials', 'Testimonials:Admin:Testimonial@gridAction')
                                       ->addOne($title);

        return $this->view->render('testimonials.form', array(
            'testimonial' => $testimonial
        ));
    }

    /**
     * Renders empty form
     * 
     * @return string
     */
    public function addAction()
    {
        $testimonial = new VirtualEntity();
        $testimonial->setPublished(true);

        return $this->createForm($testimonial, 'Add new testimonial');
    }

    /**
     * Renders edit form
     * 
     * @param string $id
     * @return string
     */
    public function editAction($id)
    {
        $testimonial = $this->getModuleService('testimonialManager')->fetchById($id, true);

        if ($testimonial !== false) {
            return $this->createForm($testimonial, 'Edit the testimonial');
        } else {
            return false;
        }
    }

    /**
     * Renders a grid
     * 
     * @return string
     */
    public function gridAction()
    {
        // Add a breadcrumb
        $this->view->getBreadcrumbBag()
                   ->addOne('Testimonials');

        return $this->view->render('browser', array(
            'title' => 'Testimonials',
            'testimonials' => $this->getModuleService('testimonialManager')->fetchAll(false)
        ));
    }

    /**
     * Saves data from the grid
     * 
     * @return string
     */
    public function tweakAction()
    {
        $tm = $this->getModuleService('testimonialManager');
        $tm->updateSettings($this->request->getPost());

        $this->flashBag->set('success', 'Settings have been updated successfully');
        return '1';
    }

    /**
     * Removes a testimonials by its associated id
     * 
     * @param string $id
     * @return string
     */
    public function deleteAction($id)
    {
        $service = $this->getModuleService('testimonialManager');

        // Batch removal
        if ($this->request->hasPost('toDelete')) {
            $ids = array_keys($this->request->getPost('toDelete'));

            $service->deleteByIds($ids);
            $this->flashBag->set('success', 'Selected elements have been removed successfully');

        } else {
            $this->flashBag->set('warning', 'You should select at least one element to remove');
        }

        // Single removal
        if (!empty($id)) {
            $service->deleteById($id);
            $this->flashBag->set('success', 'Selected element has been removed successfully');
        }

        return '1';
    }

    /**
     * Persist a testimonial
     * 
     * @return string
     */
    public function saveAction()
    {
        $input = $this->request->getPost();

        $formValidator = $this->createValidator(array(
            'input' => array(
                'source' => $input,
                'definition' => array(
                    'author' => new Pattern\Name(),
                    'content' => new Pattern\Description()
                )
            )
        ));

        if (1) {
            $service = $this->getModuleService('testimonialManager');

            if (!empty($input['testimonial']['id'])) {
                if ($service->update($input)) {
                    $this->flashBag->set('success', 'The element has been updated successfully');
                    return '1';
                }

            } else {
                if ($service->add($input)) {
                    $this->flashBag->set('success', 'The element has been created successfully');
                    return $service->getLastId();
                }
            }

        } else {
            return $formValidator->getErrors();
        }
    }
}
