<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

return array(
    '/admin/module/testimonials' => array(
        'controller' => 'Admin:Testimonial@gridAction'
    ),
    
    '/admin/module/testimonials/add' => array(
        'controller' => 'Admin:Testimonial@addAction'
    ),
    
    '/admin/module/testimonials/edit/(:var)' => array(
        'controller' => 'Admin:Testimonial@editAction'
    ),
    
    '/admin/module/testimonials/save' => array(
        'controller' => 'Admin:Testimonial@saveAction'
    ),
    
    '/admin/module/testimonials/delete' => array(
        'controller' => 'Admin:Testimonial@deleteAction'
    ),

    '/admin/module/testimonials/tweak' => array(
        'controller' => 'Admin:Testimonial@tweakAction'
    )
);