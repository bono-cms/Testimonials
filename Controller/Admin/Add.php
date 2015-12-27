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

use Krystal\Stdlib\VirtualEntity;

final class Add extends AbstractTestimonial
{
    /**
     * Displays adding form
     * 
     * @return string
     */
    public function indexAction()
    {
        $title = 'Add testimonial';
        $this->loadBreadcrumbs($title);

        $testimonial = new VirtualEntity();
        $testimonial->setPublished(true);

        return $this->view->render('testimonials.form', array(
            'title' => $title,
            'testimonial' => $testimonial
        ));
    }

    /**
     * Adds a testimonial
     * 
     * @return string
     */
    public function addAction()
    {
        $input = $this->request->getPost('testimonial');
        $formValidator = $this->getValidator($input);

        if ($formValidator->isValid()) {

            $tm = $this->getModuleService('testimonialManager');
            $tm->add($input);

            $this->flashBag->set('success', 'A testimonial has been added successfully');
            return $tm->getLastId();

        } else {
            return $formValidator->getErrors();
        }
    }
}
