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
     * @param \Krystal\Stdlib\VirtualEntity $testimonial
     * @return string
     */
    private function createForm(VirtualEntity $testimonial, $title)
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
        $testimonial = $this->getModuleService('testimonialManager')->fetchById($id);

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
        $this->view->getPluginBag()
                   ->appendScript('@Testimonials/admin/browser.js');

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
        if ($this->request->hasPost('order', 'published')) {

            $order = $this->request->getPost('order');
            $published = $this->request->getPost('published');

            $tm = $this->getModuleService('testimonialManager');
            $tm->updatePublishedStates($published);
            $tm->updateSortingOrders($order);

            $this->flashBag->set('success', 'Settings have been updated successfully');
            return '1';
        }
    }

    /**
     * Removes a testimonials by its associated id
     * 
     * @return string
     */
    public function deleteAction()
    {
        // Batch removal
        if ($this->request->hasPost('toDelete')) {
            $ids = array_keys($this->request->getPost('toDelete'));

            $tm = $this->getModuleService('testimonialManager');
            $tm->deleteByIds($ids);

            $this->flashBag->set('success', 'Selected testimonials have been removed successfully');
        }

        // Single removal
        if ($this->request->hasPost('id')) {
            $id = $this->request->getPost('id');

            $tm = $this->getModuleService('testimonialManager');
            $tm->deleteById($id);

            $this->flashBag->set('success', 'A testimonial has been removed successfully');
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
        $input = $this->request->getPost('testimonial');

        $formValidator = $this->validatorFactory->build(array(
            'input' => array(
                'source' => $input,
                'definition' => array(
                    'author' => new Pattern\Name(),
                    'content' => new Pattern\Description()
                )
            )
        ));

        if ($formValidator->isValid()) {
            $tm = $this->getModuleService('testimonialManager');

            if ($input['id']) {
                $tm = $this->getModuleService('testimonialManager');
                $tm->update($input);

                $this->flashBag->set('success', 'The testimonial has been updated successfully');
                return '1';
            } else {
                $tm->add($input);

                $this->flashBag->set('success', 'A testimonial has been added successfully');
                return $tm->getLastId();
            }

        } else {
            return $formValidator->getErrors();
        }
    }
}
