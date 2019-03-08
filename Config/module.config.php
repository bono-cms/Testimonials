<?php

/**
 * Module configuration container
 */

return array(
    'name'  => 'Testimonials',
    'description' => 'This module lets you manage testimonials on your site',
    'menu' => array(
        'name' => 'Testimonials',
        'icon' => 'fas fa-grin-wink',
        'items' => array(
            array(
                'route' => 'Testimonials:Admin:Testimonial@gridAction',
                'name' => 'View all'
            ),
            array(
                'route' => 'Testimonials:Admin:Testimonial@addAction',
                'name' => 'Add new testimonial'
            )
        )
    )
);