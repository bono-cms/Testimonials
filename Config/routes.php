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
        'controller' => 'Admin:Browser@indexAction'
    ),
    
    '/admin/module/testimonials/add' => array(
        'controller' => 'Admin:Add@indexAction'
    ),
    
    '/admin/module/testimonials/add.ajax' => array(
        'controller' => 'Admin:Add@addAction'
    )
);