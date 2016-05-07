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
    '/%s/module/testimonials' => array(
        'controller' => 'Admin:Testimonial@gridAction'
    ),
    
    '/%s/module/testimonials/add' => array(
        'controller' => 'Admin:Testimonial@addAction'
    ),
    
    '/%s/module/testimonials/edit/(:var)' => array(
        'controller' => 'Admin:Testimonial@editAction'
    ),
    
    '/%s/module/testimonials/save' => array(
        'controller' => 'Admin:Testimonial@saveAction'
    ),
    
    '/%s/module/testimonials/delete/(:var)' => array(
        'controller' => 'Admin:Testimonial@deleteAction'
    ),

    '/%s/module/testimonials/tweak' => array(
        'controller' => 'Admin:Testimonial@tweakAction'
    )
);