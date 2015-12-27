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

final class Browser extends AbstractController
{
    /**
     * Displays a grid
     * 
     * @return string
     */
    public function indexAction()
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
    public function saveAction()
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
        if ($this->request->hasPost('id')) {
            $id = $this->request->getPost('id');

            $tm = $this->getModuleService('testimonialManager');
            $tm->deleteById($id);

            $this->flashBag->set('success', 'A testimonial has been removed successfully');
            return '1';
        }
    }

    /**
     * Removes testimonials by their associated ids
     * 
     * @return string
     */
    public function deleteSelectedAction()
    {
        if ($this->request->hasPost('toDelete')) {
            $ids = array_keys($this->request->getPost('toDelete'));

            $tm = $this->getModuleService('testimonialManager');
            $tm->deleteByIds($ids);

            $this->flashBag->set('success', 'Selected testimonials have been removed successfully');
            return '1';
        }
    }
}
