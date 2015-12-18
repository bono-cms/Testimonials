<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Testimonials;

use Cms\AbstractCmsModule;
use Testimonials\Service\TestimonialManager;

final class Module extends AbstractCmsModule
{
    /**
     * {@inheritDor}
     */
    public function getServiceProviders()
    {
        $testimonialMapper = $this->getMapper('/Testimonials/Storage/MySQL/TestimonialMapper');
        $testimonialManager = new TestimonialManager($testimonialMapper);

        return array(
            'testimonialManager' => $testimonialManager
        );
    }
}
