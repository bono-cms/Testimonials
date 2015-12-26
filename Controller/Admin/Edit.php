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

final class Edit extends AbstractTestimonial
{
    /**
     * Displays edit form
     * 
     * @param string $id
     * @return string
     */
    public function indexAction($id)
    {
        $testimonial = $this->getModuleService('testimonialManager')->fetchById($id);

        if ($testimonial !== false) {

            $title = 'Edit the testimonial';
            $this->loadBreadcrumbs($title);

            return $this->view->render('testimonials.form', array(
                'title' => $title,
                'testimonial' => $testimonial
            ));

        } else {
            return false;
        }
    }

    /**
     * Updates a testimonials
     * 
     * @return string
     */
    public function updateAction()
    {
    }
}
