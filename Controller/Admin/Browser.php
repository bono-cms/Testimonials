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
        // Add a breadcrumb
        $this->view->getBreadcrumbBag()
                   ->addOne('Testimonials');

        return $this->view->render('browser', array(
            'title' => 'Testimonials',
            'testimonials' => $this->getModuleService('testimonialManager')->fetchAll(false)
        ));
    }

    /**
     * Removes a testimonials by its associated id
     * 
     * @return string
     */
    public function deleteAction()
    {
    }
}
