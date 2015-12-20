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

abstract class AbstractTestimonial extends AbstractController
{
    /**
     * Load breadcrumbs in the view
     * 
     * @param string $title Title for the last one
     * @return void
     */
    final protected function loadBreadcrumbs($title)
    {
        $this->view->getBreadcrumbBag()->addOne('Testimonials', 'Testimonials:Admin:Browser@indexAction')
                                       ->addOne($title);
    }

    /**
     * Returns prepared form validator
     * 
     * @param array $input Raw input data
     * @return \Krystal\Validate\ValidatorChain
     */
    final protected function getValidator(array $input)
    {
        return $this->validatorFactory->build(array(
            'input' => array(
                'source' => $input,
                'definition' => array(
                    'author' => new Pattern\Name(),
                    'content' => new Pattern\Description()
                )
            )
        ));
    }
}
